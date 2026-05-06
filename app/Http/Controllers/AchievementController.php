<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\UserAchievement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AchievementController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all achievements with their categories
        $allAchievements = Achievement::with('category')->get();

        // Get user's earned achievement IDs using direct query
        $earnedAchievementIds = DB::table('user_achievements')
            ->where('user_id', $user->id)
            ->pluck('achievement_id')
            ->toArray();

        // Get earned achievements
        $earnedAchievements = $allAchievements->whereIn('id', $earnedAchievementIds);

        // Calculate statistics
        $totalAchievements = $allAchievements->count();
        $earnedCount = count($earnedAchievementIds);
        $completionPercentage = $totalAchievements > 0 ? round(($earnedCount / $totalAchievements) * 100, 1) : 0;

        // Group achievements by category
        $achievementsByCategory = $allAchievements->groupBy('category_id');

        return view('achievements.index', compact(
            'allAchievements',
            'earnedAchievements',
            'totalAchievements',
            'earnedCount',
            'completionPercentage',
            'achievementsByCategory'
        ));
    }

    public function show($id)
    {
        $achievement = Achievement::with('category')->findOrFail($id);
        $user = Auth::user();

        // Check if user has earned this achievement using direct query
        $hasEarned = DB::table('user_achievements')
            ->where('user_id', $user->id)
            ->where('achievement_id', $id)
            ->exists();

        // Get users who have earned this achievement
        $earnerIds = DB::table('user_achievements')
            ->where('achievement_id', $id)
            ->pluck('user_id')
            ->toArray();

        $earners = collect();
        if (count($earnerIds) > 0) {
            $earners = User::whereIn('id', $earnerIds)
                ->with('profile')
                ->get()
                ->map(function ($user) use ($id) {
                    $awardedAt = DB::table('user_achievements')
                        ->where('user_id', $user->id)
                        ->where('achievement_id', $id)
                        ->value('awarded_at');
                    $user->awarded_at = $awardedAt;
                    return $user;
                })
                ->sortByDesc('awarded_at')
                ->take(10);
        }

        return view('achievements.show', compact(
            'achievement',
            'hasEarned',
            'earners'
        ));
    }
}
