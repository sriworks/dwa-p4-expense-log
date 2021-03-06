<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public function category()
    {
        // Define an inverse one-to-many relationship.
        return $this->belongsTo('App\TaxonomyTerm');
    }
}
