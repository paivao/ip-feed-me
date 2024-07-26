<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ListModel;
use App\Models\IPEntryModel;
use CodeIgniter\HTTP\ResponseInterface;

class Show extends BaseController
{
    public function show(string $list_name)
    {
        $list = model(ListModel::class)->where('name', $list_name)->first();
        if (is_null($list))
            return $this->response->setStatusCode(404)->setBody("Not Found.");
        $entries = model(IPEntryModel::class)->where('list_id', $list->id)->findAll();
        $body = '';
        foreach($entries as $entry) {
            $body .= "{$entry->ip_address}\n";
        }
        return $this->response->setBody($body);
    }
}
