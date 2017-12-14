<?php

namespace App\Http\Controllers;

use App\Taxonomy;
use App\TaxonomyTerm;
use App\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    /**
     * Public Controller Method to handle index page.
     * Handles GET /expense.
     */
    public function index()
    {
        $expenses = Expense::with(['category', 'tags'])
            ->orderByDesc('transaction_date')
            ->get();

        return view('expense.index')->with([
            'expenses' => $expenses,
        ]);
    }

    /**
     * Public Controller Method to handle create expense page.
     * Handles GET /expense/create.
     */
    public function showCreateForm()
    {
        $terms = TaxonomyTerm::with('taxonomy')->get();

        $categories = array();
        $tags = array();

        foreach ($terms as $term) {
            if ('category' == $term->taxonomy->api_name) {
                array_push($categories, $term->toArray());
            } else {
                array_push($tags, $term);
            }
        }

        return view('expense.create')->with([
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Public Controller Method to handle create expense.
     * Handles POST /expense.
     *
     * @param request - Http Request
     */
    public function create(Request $request)
    {
        // Validate the input
        $this->validate($request, [
            'category_id' => 'required',
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric|min:1', ]);

        // Create new expense
        $expense = new Expense();
        $expense->category_id = $request->input('category_id', '');
        $expense->memo = $request->input('memo', '');
        $expense->exclude_from_budget
            = $request->input('exclude_from_budget', 0);
        $expense->amount = $request->input('amount', '');
        $expense->transaction_date
            = Carbon::parse($request->input('transaction_date', ''));

        $expense->save();

        // Save assigned tags
        $expense->tags()->sync($request->input('tags'));

        // Redirect to index page.
        return redirect('/expense')->with([
                'message' => array('message_text' => 'Expense Created Successfully',
                'severity' => 'success', ),
            ]);
    }

    /**
     * Public Controller Method to handle expense edit page.
     * Handles GET /expense/{id}/edit.
     */
    public function showEditForm($id)
    {
        // Fetch Current Expense with tags.
        $expense = Expense::with(
            ['tags' => function ($query) {
                $query->select('taxonomy_terms.id');
            }]
        )->find($id);

        // Throw error in case of no expense found.
        if (!$expense) {
            return redirect('/expense')->with([
                'message' => array('message_text' => 'Expense not found',
                'severity' => 'danger', ),
                ]);
        }

        // Get categories and tags metadata
        $terms = TaxonomyTerm::with('taxonomy')->get();
        $categories = array();
        $tags = array();
        foreach ($terms as $term) {
            if ('category' == $term->taxonomy->api_name) {
                array_push($categories, $term->toArray());
            } else {
                array_push($tags, $term);
            }
        }

        $expense_tags = $expense->tags->pluck('id');
        $expense_arr = $expense->toArray();
        $expense_arr['tags'] = $expense_tags;

        return view('expense.edit')->with([
            'categories' => $categories,
            'tags' => $tags,
            'expense' => $expense_arr,
        ]);
    }

    /**
     * Public Controller Method to handle update expense.
     * Handles PUT /expense/{id}.
     *
     * @param request - Http Request
     */
    public function update(Request $request, $id)
    {
        // Validate the input
        $this->validate($request, [
            'category_id' => 'required',
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric|min:1', ]);

        // Find expense for the provided id.
        $expense = Expense::find($id);

        // Throw error in case of no expense found.
        if (!$expense) {
            return redirect('/expense/'.$id.'/edit')->with([
                'message' => array('message_text' => 'Expense not found',
                'severity' => 'danger', ),
                ]);
        }

        // Update the relevant attributes including tags
        $expense->tags()->sync($request->input('tags'));
        $expense->category_id = $request->input('category_id', '');
        $expense->memo = $request->input('memo', '');
        $expense->exclude_from_budget = $request->input('exclude_from_budget', 0);
        $expense->amount = $request->input('amount', '');
        $expense->transaction_date
            = Carbon::parse($request->input('transaction_date', ''));

        $expense->save();

        return redirect('/expense/'.$id.'/edit')
            ->with([
                'message' => array('message_text' => 'Expense updated Successfully!',
                'severity' => 'success', ),
                ]);
    }

    /**
     * Public Controller Method to handle delete expense.
     * Handles DELETE /expense/{id}.
     *
     * @param request - Http Request
     */
    public function delete($id)
    {
        // Find Expense with given Id
        $expense = Expense::find($id);

        // Throw error in case of no expense found!
        if (!$expense) {
            return redirect('/expense')->with([
                'message' => array('message_text' => 'Unable to find Expense with id: '.$id,
                'severity' => 'danger', ),
            ]);
        }

        // Remove tag associations before actually deleting expense.
        $expense->tags()->detach();

        $expense->delete();

        // Redirect to expense index page.
        return redirect('/expense')->with([
                'message' => array('message_text' => 'Expense Deleted Successfully!',
                'severity' => 'success', ),
            ]);
    }
}
