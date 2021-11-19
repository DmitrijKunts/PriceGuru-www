<?php

namespace App\Http\Controllers;

use App\Models\LicDownloadHistory;
use App\Models\Release;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LicenseController extends Controller
{
    private function extractLength($len)
    {
        return chr($len % 256) . chr(($len >> 8) % 256) . chr(($len >> 16) % 256) . chr(($len >> 24) % 256) .
            chr(0) . chr(0) . chr(0) . chr(0);
    }

    public function make_free()
    {
        if (!Auth::check()) {
            return Response::deny();
        }
        $version = Release::orderBy('version', 'desc')->first()->version;
        $date_s = date("d.m.Y");
        $date_e = date("d.m.Y", mktime(0, 0, 0, date("m"), date("d") + 7, date("Y")));
        $owner = Auth::user()->name . " <" . Auth::user()->email . ">\n";
        $crc = 'CRC=' . base64_encode($version . $owner) . "\n";
        $lic = "Price-Guru version $version. Registration key!\n" . $owner . $date_e . "\n" . $crc . "EndIdentyData";
        $lic = base64_encode($lic);
        $lic = gzcompress($lic, 9);

        $res = "";
        for ($i = 0; $i < strlen($lic); $i++) {
            $t = dechex(ord($lic[$i]));
            $res .= strlen($t) == 1 ? "0$t" : $t;
        }
        $res = strtoupper($res);

        LicDownloadHistory::create([
            'user_id' => Auth::id(),
            'date' => now()
        ]);

        $date_s2 = date("Y.m.d-");
        return response($res, 200)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', ' attachment; filename="' . $date_s2 . Auth::user()->email . '_v' . $version . '_' . $date_s . '_' . $date_e . '.txt"');
    }
}
