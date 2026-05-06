<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryCompletionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::patch('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::patch('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');

    // Articles
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{slug}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{slug}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{slug}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::post('/articles/{slug}/like', [ArticleController::class, 'like'])->name('articles.like');

    // Comments
    Route::post('/articles/{slug}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Questions (Admin Only)
    Route::middleware(['admin'])->group(function () {
        Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
        Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
        Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');
        Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
        Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
        Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');

        // Exams Management (Admin Only)
        Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create');
        Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');
        Route::get('/exams/{id}/edit', [ExamController::class, 'edit'])->name('exams.edit');
        Route::put('/exams/{id}', [ExamController::class, 'update'])->name('exams.update');
        Route::delete('/exams/{id}', [ExamController::class, 'destroy'])->name('exams.destroy');
    });

    // Exams Taking (All Authenticated Users)
    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/exams/{id}', [ExamController::class, 'show'])->name('exams.show');
    Route::get('/exams/{id}/take', [ExamController::class, 'take'])->name('exams.take');
    Route::post('/exams/{id}/submit', [ExamController::class, 'submit'])->name('exams.submit');
    Route::get('/exams/results/{attemptId}', [ExamController::class, 'results'])->name('exams.results');

    // Users
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

    // Category Completion Tracking
    Route::post('/articles/{articleId}/complete', [CategoryCompletionController::class, 'markArticleComplete'])->name('articles.complete');
    Route::post('/exams/{examId}/complete', [CategoryCompletionController::class, 'markExamComplete'])->name('exams.complete');
    Route::get('/categories/{categoryId}/completion', [CategoryCompletionController::class, 'getCategoryCompletionStatus'])->name('categories.completion');
    Route::get('/categories/completion', [CategoryCompletionController::class, 'getAllCategoriesCompletion'])->name('categories.all-completion');

    // Test Page
    Route::get('/test-sidebar', function () {
        return view('test-sidebar');
    })->name('test.sidebar');
});

// Public Routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/achievements/{id}', [AchievementController::class, 'show'])->name('achievements.show');
Route::get('/api/categories', function () {
    $categories = \App\Models\Category::with(['articles', 'exams'])->get();
    $categoriesWithStatus = $categories->map(function ($category) {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'articles' => $category->articles->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                ];
            }),
            'exams' => $category->exams->map(function ($exam) {
                return [
                    'id' => $exam->id,
                    'title' => $exam->title,
                ];
            }),
            'status' => [
                'total' => $category->articles->count() + $category->exams->count(),
                'completed' => 0,
                'percentage' => 0,
                'is_complete' => false,
            ],
        ];
    });

    return response()->json([
        'categories' => $categoriesWithStatus,
    ]);
})->name('api.categories');
Route::get('/categories', function () {
    return view('categories.index');
})->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Admin Routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/articles/{slug}/approve', [AdminController::class, 'approveArticle'])->name('admin.articles.approve');
    Route::post('/admin/articles/{slug}/reject', [AdminController::class, 'rejectArticle'])->name('admin.articles.reject');

    // User Management
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/{id}/promote', [AdminController::class, 'promoteToAdmin'])->name('admin.users.promote');
    Route::post('/admin/users/{id}/demote', [AdminController::class, 'demoteFromAdmin'])->name('admin.users.demote');

    // Category Management
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});
