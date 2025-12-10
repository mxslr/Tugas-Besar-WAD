<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return view('admin.dashboard'); 
        } elseif (in_array($user->role, ['mahasiswa', 'dosen'])) {
            return view('dashboard'); 
        }
        return view('dashboard'); 
    }
}
