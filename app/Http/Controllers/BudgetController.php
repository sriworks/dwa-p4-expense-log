<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Public Controller Method to handle index page.
     *
     * @param request - Http Request
     */
    public function index()
    {
        return view('budget.index');
    }
}
