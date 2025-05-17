<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Import Auth facade

// Import Livewire Components
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard;
use App\Livewire\Student\YearbookProfileForm;
use App\Livewire\Admin\ManageSubscriptions;
use App\Livewire\Superadmin\ManageRoleNames;
use App\Livewire\Superadmin\ManageUsers;
use App\Livewire\Auth\RegisterAdmin;
use App\Livewire\Admin\ViewSubscriptionDetails;
use App\Livewire\Student\ManagePhotos;
use App\Livewire\Student\AcademicArea;
use App\Livewire\Admin\ManageAcademicStructure;
use App\Livewire\Admin\PlatformSetup;
use App\Livewire\Student\SubscriptionStatus;
use App\Livewire\Admin\YearbookRepository;
use App\Livewire\Admin\ManageYearbookPlatforms;
use App\Livewire\UserProfile\UpdateAccountInformation;
use App\Livewire\UserProfile\UpdateProfileInformation;
use App\Livewire\Auth\VerifyOtp;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Student\PastYearbooks;
use App\Livewire\Student\Cart;
use App\Livewire\Student\Orders;
use App\Livewire\Admin\ManageOrders;
use App\Http\Controllers\HealthCheckController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Guest Routes ---
// Routes accessible only when the user is NOT logged in
Route::middleware('guest')->group(function () { // <<< START Guest group
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register'); // For regular students

    // --- Admin Registration Route (MOVED HERE) ---
    Route::get('/register/admin/{token}', RegisterAdmin::class)
        ->name('register.admin');

    // OTP Verification Route
    Route::get('/verify/otp', VerifyOtp::class)->name('verify.otp');

    // Password Reset Routes
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');

}); // <<< END Guest group


// --- Authenticated Routes ---
// Routes accessible only when the user IS logged in
Route::middleware('auth')->group(function () {

    // -- Routes accessible by ANY authenticated user --
    Route::get('/app', Dashboard::class)->name('app.dashboard');

    // Account Settings Route (NEW)
    Route::get('/user/account', UpdateAccountInformation::class)->name('user.account.settings');

    // Profile Settings Route (NEW)
    Route::get('/user/profile', UpdateProfileInformation::class)->name('user.profile');

    // Standard Laravel Logout Route (POST request)
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');


    // -- Student Routes --
    Route::get('/student/yearbook-profile/edit', YearbookProfileForm::class)->name('student.profile.edit');
    Route::get('/student/photos', ManagePhotos::class)->name('student.photos');
    Route::get('/student/academic', AcademicArea::class)->name('student.academic');
    Route::get('/student/subscription', SubscriptionStatus::class)->name('student.subscription.status');
    
    // Add new yearbook purchasing routes
    Route::get('/student/past-yearbooks', PastYearbooks::class)->name('student.past-yearbooks');
    Route::get('/student/cart', Cart::class)->name('student.cart');
    Route::get('/student/orders', Orders::class)->name('student.orders');

    // -- Routes accessible by ADMINS and SUPERADMINS --
    Route::middleware('role:admin,superadmin')->group(function () {
        Route::get('/admin/subscriptions', ManageSubscriptions::class)->name('admin.subscriptions.index');
        Route::get('/admin/subscriptions/{profile}', ViewSubscriptionDetails::class)->name('admin.subscriptions.show');
        Route::get('/admin/yearbook-platforms', ManageYearbookPlatforms::class)->name('admin.platforms.index');
        Route::get('/admin/repository', YearbookRepository::class)->name('admin.repository.index');
        
        // Add new order management route
        Route::get('/admin/orders', ManageOrders::class)->name('admin.orders.index');
    });

    // Academic Structure Route (Update to point to correct component)
    Route::get('/admin/academic-structure', ManageAcademicStructure::class)->name('admin.academic-structure.index'); // Changed name slightly for consistency


    // -- Routes accessible ONLY by SUPERADMINS --
    Route::middleware('role:superadmin')->group(function () {
        Route::get('/superadmin/role-names', ManageRoleNames::class)->name('superadmin.roles.index');
        Route::get('/superadmin/users', ManageUsers::class)->name('superadmin.users.index');
    });

    // REMOVED Admin registration route from here

});


// Include the auth routes from auth.php
require __DIR__.'/auth.php';

// About page route
Route::get('/about', function () {
    return view('about');
})->name('about');

// --- Root URL Redirect Logic ---
Route::get('/', function () {
    // Get active yearbook platform for display on landing page
    $activePlatform = App\Models\YearbookPlatform::where('is_active', true)->first();
    
    // Get a few past yearbooks to showcase on the landing page
    $pastYearbooks = App\Models\YearbookPlatform::where('is_active', false)
        ->where('status', 'archived')
        ->orderBy('year', 'desc')
        ->take(3)
        ->get();
        
    return view('landing', [
        'activePlatform' => $activePlatform,
        'pastYearbooks' => $pastYearbooks
    ]);
})->name('landing');

// Health check route for Render deployment
Route::get('/health', HealthCheckController::class)->name('health.check');