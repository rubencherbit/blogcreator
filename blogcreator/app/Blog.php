<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Blog;
use App\Article;

class Blog extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blogs';

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
    protected $fillable = ['title', 'description', 'banner', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function categories()
    {
        return $this->hasMany('App\Categorie');
    }
    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function months()
    {
        $years = Article::select('created_at')
            ->where('blog_id', $this->id)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m'); // grouping by months
            });
        return $years;
    }
    public function years()
    {
        $years = Article::select('created_at')
            ->where('blog_id', $this->id)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            });
        return $years;
    }
}
