<?php

namespace App\Controllers;

class Hasil extends BaseController
{
    public function index(): string
    {
        return view('admin/hasil-penilaian');
    }
}
