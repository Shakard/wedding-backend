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
        $totalLibros = Libro::count();
        $totalStudants = Studant::count();
        $totalBorroweds = Borrowed::count(); 
        $librosLawyer = Libro::where('user_id', $user)->latest()->paginate();

        return view('admin.pages.dashboard.index', compact('librosLawyer','totalUsers','totalStudants', 'totalLibros', 'totalBorroweds'));
    }

}
