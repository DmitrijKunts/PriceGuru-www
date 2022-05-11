<?php

namespace App\Http\Controllers;

use App\Actions\GenLicense;

class LicenseController extends Controller
{

    public function gen()
    {
        [$res, $fileName] = GenLicense::gen();

        return response($res, 200)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', ' attachment; filename="' . $fileName);
    }
}
