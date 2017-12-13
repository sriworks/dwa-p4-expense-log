<?php

use Illuminate\Database\Seeder;
use App\Taxonomy;

class TaxonomiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $taxonomies = [
            ['category', 'Category'],
            ['tags', 'Tags'],
        ];
        $count = count($taxonomies);
        foreach ($taxonomies as $key => $taxonomy) {
            Taxonomy::insert([
                'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                'api_name' => $taxonomy[0],
                'name' => $taxonomy[1],
            ]);
            --$count;
        }
    }
}
