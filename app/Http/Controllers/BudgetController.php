<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Taxonomy;
use App\Budget;

class BudgetController extends Controller
{
    /**
     * Public Controller Method to handle index page.
     * Handles GET /budget.
     */
    public function index()
    {
        // Query Budget with Category
        $budgets = Budget::with('category')->get();

        $categories = Taxonomy::with('taxonomy_terms')->where('api_name', '=', 'category')->get()->first();

        return view('budget.index')->with([
            'budgets' => $budgets,
            'categories' => $categories->taxonomy_terms,
        ]);
    }

    /**
     * Public Controller Method to handle create budget operation.
     * Handles POST /budget.
     *
     * @param request - Http Request
     */
    public function create(Request $request)
    {
        // Make custom validator as we have to do additional validations.
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'monthly_budgeted_amount' => 'required|numeric|min:1',
            ]);

        // Redirect to budget index with validation errors.
        if ($validator->fails()) {
            return redirect('/budget')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Check for existing budget entry with same category.
        $budgetId = Budget::where('category_id', '=', $request->input('category'))->pluck('id')->first();
        if ($budgetId) {
            $validator->errors()->add('category', 'Budget for the given category already exists!');

            return redirect('/budget')
                    ->withErrors($validator)
                    ->withInput();
        }

        // Insert Budget
        Budget::insert([
                'category_id' => $request->input('category', ''),
                'monthly_budgeted_amount' => $request->input('monthly_budgeted_amount', 0),
            ]);

        // Redirect to budget index page.
        return redirect('/budget')->with([
                'message' => array('message_text' => 'Budget Created Successfully',
                'severity' => 'success', ),
            ]);
    }

    /**
     * Public Controller Method to handle create budget operation.
     * Handles DELETE /budget/{id}.
     *
     * @param request - Http Request
     */
    public function delete($id)
    {
        // Find Budget with given Id
        $budget = Budget::find($id);

        if (!$budget) {
            return redirect('/budget')->with([
                'message' => array('message_text' => 'Unable to find Budget with id: '.$id, 'severity' => 'danger'),
            ]);
        }

        $budget->delete();

        // Redirect to budget index page.
        return redirect('/budget')->with([
                'message' => array('message_text' => 'Budget Deleted Successfully', 'severity' => 'success'),
            ]);
    }
}
