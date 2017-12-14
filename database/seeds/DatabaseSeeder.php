<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call(TaxonomiesTableSeeder::class);
        $this->call(TaxonomyTermsTableSeeder::class);
        $this->call(BudgetsTableSeeder::class);
        $this->call(ExpensesTableSeeder::class);
        $this->call(ExpenseTaxonomyTermsTableSeeder::class);
    }
}
