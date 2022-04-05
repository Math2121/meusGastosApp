<?php

use App\Http\Livewire\Expense\ExpenseCreate;
use App\Http\Livewire\Expense\ExpenseEdit;
use App\Http\Livewire\Expense\ExpenseList;
use App\Http\Livewire\Payment\CreditCard;
use App\Http\Livewire\Plan\PlanCreate;
use App\Http\Livewire\Plan\PlanList;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('expenses')->name('expenses')->group(function () {
        Route::get("/create", ExpenseCreate::class)->name('create');
        Route::get('/edit/{expense}', ExpenseEdit::class)->name('edit');
        Route::get('/', ExpenseList::class)->name('index');

        Route::get("/{expense}/photo", function ($expense) {
            $expense = auth()->user()->expenses()->findOrFail($expense);

            if (!Storage::disk('public')->exists($expense->photo))
                return abort(404, 'Image not FOund');

            $image = Storage::disk('public')->get($expense->photo);

            $mimeType = File::mimeType(storage_path('app/public/' . $expense->photo));


            return response($image)->header('Content-Type', $mimeType);
        })->name('photo');
    });

    Route::prefix('plans')->name('plans.')->group(function () {
        Route::get('/', PlanList::class)->name('index');
        Route::get('/create', PlanCreate::class)->name('create');
    });
});

Route::get("subscription", CreditCard::class)->name('plan.subscription');


Route::get('notifications',function(){
$code='09FD4BA1C2C2AF1DD4718F84F34F372C';

return (new \App\Services\PagSeguro\Subscription\SubscriptionHeaderService())->getSubscriptionByCode($code);


});
