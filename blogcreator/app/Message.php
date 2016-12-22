<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

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
    protected $fillable = ['receiver_id', 'title', 'content', 'sender_id', 'is_read'];

    public function sender() {
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo('App\User', 'receiver_id');

    }

    public function isRead() {
        return ($this->is_read === 0) ? 'Not read' : 'Read';
    }

    public function markAsRead() {
        $this->update(['is_read' => 1]);
        return true;
    }
}
