<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    // Inverse one-to-many for Category.
    public function category()
    {
        // Define an inverse one-to-many relationship.
        return $this->belongsTo('App\TaxonomyTerm');
    }

    /*
    * Relationship method for tags
    */
    public function tags()
    {
        return $this->belongsToMany('App\TaxonomyTerm')->withTimestamps();
    }
}
