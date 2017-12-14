<?php

use Illuminate\Database\Seeder;
use App\Expense;
use App\Taxonomy;
use App\TaxonomyTerm;

class ExpenseTaxonomyTermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $expenses = Expense::select('id')->orderByDesc('transaction_date')->limit(5)->get();

        $taxonomy_tags_id = Taxonomy::where('api_name', '=', 'tags')->pluck('id')->first();

        $terms = TaxonomyTerm::where('taxonomy_id', '=', $taxonomy_tags_id)->select('id')->get();

        $terms_array = $terms->toArray();

        foreach ($expenses as $expense) {
            $random_terms_idx = array_rand($terms_array, rand(1, 3));
            $tags = array();
            if ('array' == gettype($random_terms_idx)) {
                foreach ($random_terms_idx as $index) {
                    array_push($tags, $terms_array[$index]['id']);
                }
            } else {
                array_push($tags, $terms_array[$random_terms_idx]['id']);
            }
            $expense->tags()->sync($tags);
        }
    }
}
