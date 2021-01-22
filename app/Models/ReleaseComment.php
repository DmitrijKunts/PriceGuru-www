<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseComment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'message',
        'user_id',
        'release_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function release()
    {
        return $this->belongsTo(Release::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }
}
