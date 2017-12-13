<?php

use Illuminate\Database\Seeder;
use App\Taxonomy;
use App\TaxonomyTerm;

class TaxonomyTermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // See Categories & Tags as Taxonomies
        $taxonomy_categories = [
            ['category', 'Mortgage/Rent'],
            ['category', 'Auto'],
            ['category', 'Entertainment'],
            ['category', 'Shopping'],
            ['category', 'Utilities'],
            ['tags', 'Rent'],
            ['tags', 'Parents'],
            ['tags', 'Mobile Payment'],
            ['tags', 'Gas Bill'],
            ['tags', 'Online Transfer'],
            ['tags', 'Cash Payment'],
            ['tags', 'Avoid In Future'],
        ];
        $count = count($taxonomy_categories);
        foreach ($taxonomy_categories as $key => $taxonomy_categories) {
            $taxonomy_id = Taxonomy::where('api_name', '=', $taxonomy_categories[0])->pluck('id')->first();

            TaxonomyTerm::insert([
                'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'term' => $taxonomy_categories[1],
                'taxonomy_id' => $taxonomy_id,
            ]);
            --$count;
        }
    }
}
