<?php

namespace App\Controllers;

use App\Models\ListModel;

class HomeController extends BaseController
{
    public function index(): string
    {
        $lists = model(ListModel::class)->findAll();
        return view('home', [
            "title" => "Home",
            "user" => auth()->user(),
            "lists" => $lists,
        ]);
    }
}
