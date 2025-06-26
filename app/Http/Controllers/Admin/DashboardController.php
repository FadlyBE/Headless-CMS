<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
