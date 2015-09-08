<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETE = 'complete';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'filename', 'path', 'mime_type', 'text', 'location', 'status'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
