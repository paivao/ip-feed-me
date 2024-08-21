<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class IPEntry extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'is_enabled' => 'boolean',
        'netmask' => '?integer',
    ];

    public function setIpAddress(string $ip_address) {
        @list($ip, $mask) = explode('/', $ip_address, 2);
        $packed = inet_pton($ip);
        $this->attributes['ip_address'] = $packed;
        $this->__set('netmask', $mask ?? ((strlen($packed) == 4) ? 32 : 128));
        //throw new \ErrorException(print_r($this->attributes, true));
    }

    public function getIpAddress() {
        $ip = $this->attributes['ip_address'];
        $l = strlen($ip);
        if ($l == 4 || $l == 16) {
            return inet_ntop(pack("A" . $l, $ip));
        }
        //return inet_ntop($value);
        return $ip;
    }

    public function getIpVersion() {
        return strlen($this->attributes['ip_address']);
    }
}
