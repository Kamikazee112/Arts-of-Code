<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get user statistics
        $articlesCount = $user->articles()->count();
        $quizAttemptsCount = $user->quizAttempts()->count();

        // Get achievements count using direct query
        $achievementsCount = DB::table('user_achievements')
            ->where('user_id', $user->id)
            ->count();

        return view('dashboard', compact(
            'articlesCount',
            'quizAttemptsCount',
            'achievementsCount'
        ));
    }
}
