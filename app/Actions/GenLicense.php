<?php

namespace App\Actions;

use App\Models\LicDownloadHistory;
use App\Models\Release;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GenLicense
{
    public static function gen()
    {
        $currUser = Auth::user();
        $version = Release::orderBy('version', 'desc')->first()->version;
        $date_s = now()->format("d.m.Y");
        $date_e = now()->addDays(28)->format("d.m.Y");
        $owner = "{$currUser->name} <{$currUser->email}>\n";
        $crc = 'CRC=' . base64_encode($version . $owner) . "\n";
        $lic = "Price-Guru version {$version}. Registration key!\n{$owner}{$date_e}\n{$crc}EndIdentyData";
        $lic = base64_encode($lic);
        $lic = gzcompress($lic, 9);

        $res = "";
        for ($i = 0; $i < strlen($lic); $i++) {
            $t = dechex(ord($lic[$i]));
            $res .= strlen($t) == 1 ? "0$t" : $t;
        }

        $res = Str::upper($res);

        $fileName = "{$date_s}-{$currUser->email}_v{$version}_{$date_s}_{$date_e}.txt";

        LicDownloadHistory::create([
            'user_id' => Auth::id(),
            'date' => now()
        ]);

        return [$res, $fileName];
    }
}
