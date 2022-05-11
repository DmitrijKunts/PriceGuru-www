<?php

namespace App\Models;

use App\Mail\LicenseGen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class LicDownloadHistory extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::created(function ($ldh) {
            Mail::to(config('mail.contactAddress', "admin@admin.net"))->send(new LicenseGen($ldh->user));
        });
    }
}
