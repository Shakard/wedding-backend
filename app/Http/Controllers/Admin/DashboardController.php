<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowed;
use App\Models\Category;
use App\Models\Libro;
use App\Models\Studant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $user = auth()->user()->id;
        $totalUsers = User::count();

        return view('admin.pages.dashboard.index', compact('totalUsers'));
    }

}
