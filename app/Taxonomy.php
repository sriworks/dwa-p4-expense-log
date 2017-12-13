<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    public function taxonomy_terms()
    {
        // Define a one-to-many relationship.
        return $this->hasMany('App\TaxonomyTerm');
    }

    public function categories()
    {
        // this might be $this->hasOne... depends on what you need
        return $this->hasMany('App\TaxonomyTerm')->where('api_name', '=', 'category');
    }
}
