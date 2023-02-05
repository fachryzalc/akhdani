<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'sidebar' => 'home'
        ];
        return view('home', $data);
    }
}
