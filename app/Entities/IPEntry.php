<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class IPEntry extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'ip_address' => 'ip',
        'is_enabled' => 'boolean',
    ];

    protected $castHandlers = [
        'ip' => Cast\IPCast::class,
    ];
}
