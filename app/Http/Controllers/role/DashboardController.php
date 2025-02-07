<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\AuthCheck;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(AuthCheck::class);
    }

    public function index()
    {
        return view('dashboard');
    }
}
