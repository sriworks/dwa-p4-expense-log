<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxonomyTerm extends Model
{
    public function taxonomy()
    {
        // Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Taxonomy');
    }
}
