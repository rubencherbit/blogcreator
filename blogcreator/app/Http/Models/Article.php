<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article';


    public function blog()
    {
        return $this->belongsTo('App\Models\Blog');
    }

    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}