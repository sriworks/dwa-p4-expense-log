<?php

namespace App\Http\Controllers;

use App\TaxonomyTerm;

class SettingsController extends Controller
{
    /**
     * Public Controller Method to handle index page.
     * Handles GET /taxonomy.
     */
    public function index()
    {
        // Fetch all terms including categories and tags.
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

        return view('settings.index')->with([
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
