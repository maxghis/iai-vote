<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatriculeController extends Controller
{
    public function create()
    {
        return view("create");
    }
    public function store(Request $request)
    {
        dd($request->matricule);
    }
}
