<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['blog_id', 'name', 'description'];

    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }
    public function articles() {
        return $this->hasMany('App\Article');
    }

}
