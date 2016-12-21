<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Attachment;

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

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }

    public function proceedAttachments($attachments)
    {
        foreach($attachments as $attachment) {
            if($attachment->isValid()) {
                $uploadPath = public_path('uploads/attachments/');

                $extension = $attachment->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;
                $attachment->move($uploadPath, $fileName);

                $attachment = new Attachment;
                $attachment->hash = $fileName;
                $attachment->article_id = $this->id;
                $attachment->save();
            }
        }
    }
}
