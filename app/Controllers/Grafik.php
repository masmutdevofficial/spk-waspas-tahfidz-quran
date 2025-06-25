<?php

namespace App\Controllers;

class Grafik extends BaseController
{
    public function index(): string
    {
        return view('admin/grafik-kriteria');
    }
}
