<?php

namespace App\Controllers;

class Kriteria extends BaseController
{
    public function index(): string
    {
        return view('admin/data-kriteria');
    }
}
