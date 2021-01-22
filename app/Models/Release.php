<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use \App\Models\ReleaseComment;

class Release extends Model
{
    use HasFactory;

    protected $fillable = [
        'version',
        'description',
        'file_inst',
        'file_arc',
    ];

    static public function humanSize($file)
    {
        $bytes = Storage::size($file);
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }

    public function comments()
    {
        return $this->hasMany(ReleaseComment::class)->orderBy('created_at', 'desc');
    }
}
