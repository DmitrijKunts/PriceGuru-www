<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('videos');
    }
}
