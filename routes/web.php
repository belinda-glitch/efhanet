<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AntigravityAIController;
use App\Http\Controllers\PartnerController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/tentang-kami', [LandingController::class, 'about'])->name('about');
Route::get('/layanan', [LandingController::class, 'services'])->name('services');
Route::get('/portofolio', [LandingController::class, 'portfolio'])->name('portfolio');
Route::get('/kontak', [LandingController::class, 'contact'])->name('contact');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/projects', [ClientController::class, 'index'])->name('projects.index');
    Route::get('/projects/{id}', [ClientController::class, 'show'])->name('projects.show');
    Route::get('/projects/{id}/insight', [ClientController::class, 'insight'])->name('projects.insight');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Specific Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/clients', [AdminController::class, 'clients'])->name('clients.index');
        Route::get('/clients/{id}', [AdminController::class, 'clientShow'])->name('clients.show');
        
        // Manajemen Proyek
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::post('/projects/{id}/update-status', [ProjectController::class, 'updateStatus'])->name('projects.update-status');
        
        // Manajemen Layanan
        Route::get('/services', [AdminController::class, 'servicesIndex'])->name('services.index');
        Route::post('/services', [AdminController::class, 'servicesStore'])->name('services.store');
        Route::delete('/services/{id}', [AdminController::class, 'servicesDestroy'])->name('services.destroy');

        // Manajemen Portofolio
        Route::get('/portfolio-manage', [PortfolioController::class, 'index'])->name('portfolio.index');
        Route::post('/portfolio-group', [PortfolioController::class, 'storeGroup'])->name('portfolio.group.store');
        Route::post('/portfolio-item', [PortfolioController::class, 'storeItem'])->name('portfolio.item.store');
        Route::delete('/portfolio-group/{id}', [PortfolioController::class, 'destroyGroup'])->name('portfolio.group.destroy');
        Route::delete('/portfolio-item/{id}', [PortfolioController::class, 'destroyItem'])->name('portfolio.item.destroy');

        // AI Forecasting
        Route::get('/projects/{id}/forecast', [AntigravityAIController::class, 'index'])->name('projects.forecast');

        // Manajemen Pengeluaran
        Route::post('/projects/{id}/expenses', [ProjectController::class, 'storeExpense'])->name('expenses.store');
        Route::post('/expenses/{id}/upload-nota', [ProjectController::class, 'updateNota'])->name('expenses.update-nota');
        
        // Dokumentasi Proyek
        Route::post('/projects/{id}/documentations', [ProjectController::class, 'storeDocumentation'])->name('documentations.store');
        Route::delete('/documentations/{id}', [ProjectController::class, 'destroyDocumentation'])->name('documentations.destroy');

        // Manajemen Partner Strategis
        Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
        Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
        Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
    });
});
