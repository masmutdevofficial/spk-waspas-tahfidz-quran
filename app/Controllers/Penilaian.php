<?php

namespace App\Controllers;

class Penilaian extends BaseController
{
    public function index(): string
    {
        return view('admin/penilaian');
    }
}
