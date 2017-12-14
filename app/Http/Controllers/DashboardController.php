<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Expense;
use DB;

class DashboardController extends Controller
{
    /**
     * Public Controller Method to handle index page.
     * Handles GET /.
     */
    public function index()
    {
        // Get Top Expenses this month
        $expenses = Expense::with(['category', 'tags'])
            ->whereMonth('transaction_date', '=', date('m'))
            ->whereYear('transaction_date', '=', date('Y'))
            ->orderByDesc('amount')
            ->limit(10)
            ->get();

        return view('dashboard.index')->with([
            'expenses' => $expenses,
        ]);
    }

    /**
     * Public Controller Method to handle budget trends. Get allocated budget
     * categories and total expense amount for each category and return in a
     * JSON that is friendly to chart.js front end.
     * Handles GET /dashboard/budget-trends. Returns JSON.
     */
    public function budgetTrends()
    {
        // Get Budget with Categories
        $budgets = Budget::with('category')->get();
        $categoryMap = array();
        foreach ($budgets as $budget) {
            $categoryMap[$budget->category_id] = array(
                'term' => $budget->category->term,
                'monthly_budgeted_amount' => $budget->monthly_budgeted_amount,
                'expense_amount' => 0,
                );
        }

        // Get Expenses for this month for the budgeted categories
        $expenses = Expense::with(['category'])
            ->whereIn('category_id', array_keys($categoryMap))
            ->whereMonth('transaction_date', '=', date('m'))
            ->whereYear('transaction_date', '=', date('Y'))
            ->where('exclude_from_budget', '=', false)
            ->selectRaw('category_id,sum(amount) as expense_amount')
            ->groupBy('category_id')
            ->get();

        $expense_dataset = array();
        foreach ($expenses as $expense) {
            $categoryMap[$expense->category_id]['expense_amount'] =
                $expense->expense_amount;
        }

        // Collect parallel data sets
        $labels = array();
        $budget_dataset = array();
        $expense_dataset = array();
        foreach ($categoryMap as $key => $category) {
            array_push($labels, $category['term']);
            array_push($budget_dataset, $category['monthly_budgeted_amount']);
            array_push($expense_dataset, $category['expense_amount']);
        }

        // Consolidate the data sets.
        $trends = array();
        $trends['labels'] = $labels;
        $trends['datasets'] = array();
        array_push($trends['datasets'], array(
             'label' => 'Budget',
             'backgroundColor' => '#8e5ea2',
             'data' => $budget_dataset,
             ));
        array_push($trends['datasets'], array(
         'label' => 'Expense',
         'backgroundColor' => '#3e95cd',
         'data' => $expense_dataset,
         ));

        //dump($trends);

        return response()->json($trends);
    }

    /**
     * Public Controller Method to handle expense trends. Gets list of expenses
     * grouped by month for a current year.
     * Handles GET /dashboard/expense-trends. Returns JSON.
     */
    public function expenseTrends()
    {
        // Expense Trends this year.
        $yearMap = array(
            '1' => array('label' => 'January', 'expense_amount' => 0),
            '2' => array('label' => 'February', 'expense_amount' => 0),
            '3' => array('label' => 'March', 'expense_amount' => 0),
            '4' => array('label' => 'April', 'expense_amount' => 0),
            '5' => array('label' => 'May', 'expense_amount' => 0),
            '6' => array('label' => 'June', 'expense_amount' => 0),
            '7' => array('label' => 'July', 'expense_amount' => 0),
            '8' => array('label' => 'August', 'expense_amount' => 0),
            '9' => array('label' => 'September', 'expense_amount' => 0),
            '10' => array('label' => 'October', 'expense_amount' => 0),
            '11' => array('label' => 'November', 'expense_amount' => 0),
            '12' => array('label' => 'December', 'expense_amount' => 0),
            );

        $expenses =
            Expense::selectRaw('MONTH(transaction_date) 
            as transaction_month,sum(amount) as expense_amount')
            ->whereYear('transaction_date', '=', date('Y'))
            ->groupBy(DB::raw('MONTH(transaction_date)'))
            ->get();

        foreach ($expenses as $expense) {
            $yearMap[$expense->transaction_month]['expense_amount']
                = $expense->expense_amount;
        }

        $labels = array();
        $expense_dataset = array();
        foreach ($yearMap as $key => $value) {
            array_push($labels, $value['label']);
            array_push($expense_dataset, $value['expense_amount']);
        }

        $trends = array();
        $trends['labels'] = $labels;
        $trends['datasets'] = array();
        array_push($trends['datasets'], array(
             'label' => 'Expense',
             'backgroundColor' => '#8e5ea2',
             'data' => $expense_dataset,
             ));

        return response()->json($trends);
    }
}
