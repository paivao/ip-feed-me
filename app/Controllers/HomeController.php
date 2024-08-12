<?php

namespace App\Controllers;

use App\Models\ListModel;

class HomeController extends BaseController
{
    public function index(): string
    {
        $lists = model(ListModel::class)->findAll();
        $list_arr = [];
        array_walk($lists, function($el) use (&$list_arr) {
            $list_arr[$el['name']] = "/list/edit/{$el['id']}";
        });
        return view('home', [
            "title" => "Home",
            "user" => auth()->user(),
            "lists" => $list_arr,
        ]);
    }

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
