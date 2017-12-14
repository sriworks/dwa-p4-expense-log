<?php

use Illuminate\Database\Seeder;
use App\Expense;
use App\Taxonomy;
use App\TaxonomyTerm;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $expenses = [
            ['Auto', '2017-01-16', 100, 'Monthly EMI', false],
            ['Auto', '2017-02-16', 150, 'Monthly EMI', false],
            ['Auto', '2017-03-16', 100, 'Monthly EMI', false],
            ['Auto', '2017-12-16', 100, 'Monthly EMI', false],
            ['Entertainment', '2017-04-17', 250, 'Monthly Movie', false],
            ['Entertainment', '2017-05-17', 550, 'Monthly Movie', false],
            ['Entertainment', '2017-06-17', 250, 'Monthly Movie', false],
            ['Entertainment', '2017-12-17', 250, 'Monthly Movie', false],
            ['Mortgage/Rent', '2017-07-17', 2050, 'Mortgage Payment', false],
            ['Mortgage/Rent', '2017-08-17', 250, 'Mortgage Payment', false],
            ['Mortgage/Rent', '2017-09-17', 250, 'Mortgage Payment', false],
            ['Mortgage/Rent', '2017-12-17', 1250, 'Mortgage Payment', false],
            ['Shopping', '2017-10-18', 200, 'Groceries', false],
            ['Shopping', '2017-11-18', 200, 'Groceries', false],
            ['Shopping', '2017-12-18', 200, 'Groceries', false],
        ];

        $taxonomy_category_id = Taxonomy::where('api_name', '=', 'category')->pluck('id')->first();

        $count = count($expenses);
        foreach ($expenses as $expense) {
            $category_id = TaxonomyTerm::where('taxonomy_id', '=', $taxonomy_category_id)->where('term', $expense[0])->pluck('id')->first();

            Expense::insert([
                'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'category_id' => $category_id,
                'transaction_date' => $expense[1],
                'amount' => $expense[2],
                'memo' => $expense[3],
                'exclude_from_budget' => $expense[4],
            ]);
            --$count;
        }
    }
}
