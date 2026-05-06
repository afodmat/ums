<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.index');
        } elseif ($user->hasRole('lecturer')) {
            return redirect()->route('lecturer.dashboard');
        } elseif ($user->hasRole('student')) {
            return redirect()->route('student.dashboard');
        } elseif ($user->hasRole('finance')) {
            return redirect()->route('finance.dashboard');
        }
        
        // Fallback
        return view('dashboard');
    }
}