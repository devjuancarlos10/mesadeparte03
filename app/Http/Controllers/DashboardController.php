<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('welcome'); // Asegúrate de tener la vista 'dashboard.blade.php'
    }
}
