<?php

use Illuminate\Database\Seeder;
use App\Budget;
use App\Taxonomy;
use App\TaxonomyTerm;

class BudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $budgetMap = array('Auto' => 500, 'Mortgage/Rent' => 2000, 'Entertainment' => 250, 'Shopping' => 250);

        // Get Taxonomy Id for category.
        $category_id = Taxonomy::where('api_name', '=', 'category')->pluck('id')->first();

        $taxonomy = TaxonomyTerm::where('taxonomy_id', '=', $category_id)->whereIn('term', array('Auto', 'Mortgage/Rent', 'Entertainment', 'Shopping'))->get();

        $count = count($taxonomy->toArray());

        foreach ($taxonomy as $term) {
            Budget::insert([
                'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'category_id' => $term->id,
                'monthly_budgeted_amount' => $budgetMap[$term->term],
            ]);
            --$count;
        }
    }
}
