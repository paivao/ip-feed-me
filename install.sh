#!/bin/bash

echo "--- This script is an quick & easy bootstrap for development ---"

for comm in {php,composer,sudo}; do
    if [[ -z "$(type -p $comm)" ]]; then
        echo "$comm not found! Be sure that $comm is installed"
        exit 1
    fi
done

echo "[+] Downloading and installing components"
composer install

echo "[+] Creating database and username"
# Change here if you cannot run mysql passwordless as root
random_mysql_password="$(cat /dev/random | tr -dc '[:alnum:]' | head -c 20)"
sudo mysql -u root <<END
CREATE DATABASE IF NOT EXISTS \`feed_me\`;
DROP USER IF EXISTS \`feed_me\`@\`localhost\`;
CREATE USER \`feed_me\`@\`localhost\` IDENTIFIED BY "$random_mysql_password";
GRANT ALL ON \`feed_me\`.* to \`feed_me\`@\`localhost\`;
END

echo
echo "[+] Creating .env file"
cp env .env

random_prefix="$(cat /dev/random | tr -dc '[:alnum:]' | head -c 4)_"
sed -i '/CI_ENVIRONMENT/ c CI_ENVIRONMENT = development' .env
sed -i '/app\.baseURL/ c app.baseURL = '"'http://127.0.0.1:8080/\'" .env
sed -i '/database\.default\.hostname/ s/\# //' .env
sed -i '/database\.default\.DBDriver/ s/\# //' .env
sed -i '/database\.default\.database/ c database.default.database = feed_me' .env
sed -i '/database\.default\.username/ c database.default.username = feed_me' .env
sed -i '/database\.default\.password/ c database.default.password = '"'$random_mysql_password'" .env
sed -i '/database\.default\.DBPrefix/ c database.default.DBPrefix = '"'$random_prefix'" .env
# Change if you don't use default port
#sed -i '/database\.default\.port = 3306' .env

echo
echo "[+] Migrating database"
php spark migrate --all

echo
echo "[+] Generating administrador"
echo "[>] Username: admin, group: superadmin, e-mail: admin@feed.me, password: klapaucius"
echo -e "klapaucius\nklapaucius" | php spark shield:user create -n admin -e admin@feed.me

echo
echo "[+] Starting server"
php spark serve
