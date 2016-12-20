<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

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
    protected $fillable = ['blog_id', 'user_id', 'title', 'description', 'categorie_id', 'content', 'files'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }
    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
