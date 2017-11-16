<?php

use Illuminate\Database\Seeder;
use App\Budget;

class BudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $budgets = [
            ['Loans', 500],
            ['Mortgage', 2000],
            ['Entertainment', 250],
        ];
        $count = count($budgets);
        foreach ($budgets as $key => $budget) {
            Budget::insert([
                'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'budget_category' => $budget[0],
                'monthly_budgeted_amount' => $budget[1],
            ]);
            --$count;
        }
    }
}
