<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YearbookPlatform;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    /**
     * Display the landing page
     */
    public function index()
    {
        // Redirect authenticated users to dashboard
        if (Auth::check()) {
            return redirect()->route('app.dashboard');
        }
        
        // Get active yearbook platform for display on landing page
        $activePlatform = YearbookPlatform::where('is_active', true)->first();
        
        // Get a few past yearbooks to showcase on the landing page
        $pastYearbooks = YearbookPlatform::where('is_active', false)
            ->where('status', 'archived')
            ->orderBy('year', 'desc')
            ->take(3)
            ->get();
            
        return view('landing', [
            'activePlatform' => $activePlatform,
            'pastYearbooks' => $pastYearbooks
        ]);
    }
}
