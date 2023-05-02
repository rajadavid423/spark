<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpenAiController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware('auth')->group(static function () {
    Route::get('/', function () {
            return redirect()->route('home');
    });
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('change-password', [EmployeeController::class, 'changePassword'])->name('change-password');
    Route::post('password-update', [EmployeeController::class, 'passwordUpdate'])->name('password-update');
    Route::post('global-search', [HomeController::class, 'globalSearch'])->name('globalSearch');

    Route::resource('role', RoleController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('product-category', ProductCategoryController::class)->except(['create', 'edit']);
    Route::resource('product', ProductController::class);
    Route::resource('sale', SaleController::class);
    Route::get('get-product-list/{category_id}', [ProductController::class, 'getProductList']);

    Route::get('open-ai/text-completion', [OpenAiController::class, 'textCompletionPage'])->name('open-ai.text-completion');
    Route::post('open-ai/text-completion', [OpenAiController::class, 'textCompletionApi'])->name('open-ai.text-completion-api');
    Route::get('open-ai/image-generate', [OpenAiController::class, 'imageGeneratePage'])->name('open-ai.image-generate');
    Route::post('open-ai/image-generate', [OpenAiController::class, 'imageGenerateApi'])->name('open-ai.image-generate-api');
    Route::get('open-ai/text-classification', [OpenAiController::class, 'textClassificationPage'])->name('open-ai.text-classification');
    Route::post('open-ai/text-classification', [OpenAiController::class, 'textClassificationApi'])->name('open-ai.text-classification-api');});

Route::get('student-list', [ProductController::class, 'getStudentList']);
