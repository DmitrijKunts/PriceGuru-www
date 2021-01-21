<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use HasFactory;

    protected $fillable = [
        'version',
        'description',
        'file_inst',
        'file_arc',
    ];


    public function getCreatedAtAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }
}
