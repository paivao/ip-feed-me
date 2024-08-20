# IP Feed ME

This is the IP Feed Management Engine
> for the lack of a better name.

## What are IP Feeds?

IP feeds are a simple, yet powerfull tool. It is, at a glance, a list of IPs, one at a line.

They are used to create **allowlists** and **blocklists** to be fed into appliances, such as firewalls.

## And why this system?

This is an simple IP Feed management ~engine~ (system), created with PHP.

It has two components.

The first one is an web management interface, where you can create lists, grant permission on them, add IP
entries, enable/disable them, and set an timeout.

The second one is an feed endpoint. It enables anyone and any equipment to fetch the feed, as an text entry.
The endpoint can also be protected, either by IP or by authenticated access, which using API key or credentials.

It uses CodeIgniter4 (with CodeIgniter Shield) as the backend frameword, and HTMX and Bootstrap for frontend.

It is capable of:
- Manage IP lists, each public or private
- Add/remove IPs from each list, with an optional description
- Enable/diable IPs (for not showing into feeds without having to revome them)
- Getting an feed list (an `plain/text` endpoint)
- Create users
- Grand api keys
- Create an timeout for each entry

This is an work in progress, any sugestion will be wellcome. And any contribution too ;)
