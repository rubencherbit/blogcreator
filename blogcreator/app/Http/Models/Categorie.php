<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorie';

    public function blog()
    {
        return $this->belongsTo('App\Models\Blog');
    }
}