<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class logic extends BaseController
{
    public function index()
    {
       $data['judul'] = "Nama Halaman Logic";
       return view('logic/index', $data);
    }
}
