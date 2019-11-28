<?php

namespace App\Http\Controllers;

use App\Manager;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        return view('home', [
            'managersCount' => Manager::count()
        ]);
    }
}
