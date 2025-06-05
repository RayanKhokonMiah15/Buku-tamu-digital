<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())
            ->with(['handlingGuru'])
            ->orderByDesc('created_at')
            ->get();

        return view('dashboard', compact('reports'));
    }
}
