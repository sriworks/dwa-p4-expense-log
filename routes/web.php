<?php

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

// Home Routes.
Route::get('/', 'DashboardController@index');

// Dashboard API Routes
Route::get('/dashboard/budget-trends', 'DashboardController@budgetTrends'); // Returns Json
Route::get('/dashboard/expense-trends', 'DashboardController@expenseTrends'); // Returns Json

// Expense related Routes
Route::get('/expense', 'ExpenseController@index'); // Expense List Page
Route::get('/expense/create', 'ExpenseController@showCreateForm'); // Create page for Expense
Route::post('/expense', 'ExpenseController@create'); // Create Expense
Route::get('/expense/{id}/edit', 'ExpenseController@showEditForm'); // Edit Page for Expense
Route::put('/expense/{id}', 'ExpenseController@update');  // Update Expense
Route::delete('/expense/{id}', 'ExpenseController@delete'); // Delete Expense

// Expense related Routes
Route::get('/budget', 'BudgetController@index'); // Budget List Page
Route::post('/budget', 'BudgetController@create'); // Create Budget
Route::DELETE('/budget/{id}', 'BudgetController@delete'); // DELETE Budget

// Settings related Routes
Route::get('/taxonomy', 'SettingsController@index'); // Taxonomy Page

// Just for Debug
Route::get('/debug', function () {
    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    //$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});
