<?php

use Illuminate\Database\Seeder;
use App\Expense;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $expenses = [
            ['Loans', '2017-11-16', 100, 'Monthly EMI', false],
            ['Mortgage', '2017-11-17', 200, 'Mortgage Payment', false],
            ['Entertainment', '2017-11-18', 100, 'Indian Movie', false],
        ];
        $count = count($expenses);
        foreach ($expenses as $key => $expense) {
            Expense::insert([
                'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'expense_category' => $expense[0],
                'transaction_date' => $expense[1],
                'amount' => $expense[2],
                'memo' => $expense[3],
                'exclude_from_budget' => $expense[4],
            ]);
            --$count;
        }
    }
}
