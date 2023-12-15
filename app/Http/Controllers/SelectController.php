<?php

namespace App\Http\Controllers;

use App\Selects;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function index()
    {
        return Selects::all();
    }
}
