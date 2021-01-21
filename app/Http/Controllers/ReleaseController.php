<?php

namespace App\Http\Controllers;

use App\Models\Release;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $releases = Release::orderBy('created_at', 'desc')->get();
        return view('releases.index', compact('releases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('release-master'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('releases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('release-master')) {
            abort(403);
        }
        //dd($request->file_inst);
        $validate = $request->validate([
            'version' => 'required|digits_between:1,999999',
            'file_inst' => 'required|file|max:99999999',
            'file_arc' => 'required|file|max:99999999',
        ]);


        $file_inst = $request->file_inst->storeAs('file_inst', $request->file_inst->getClientOriginalName());
        $validate['file_inst'] = $file_inst;

        //$ext = $request->file_arc->extension() ?? '.exe';
        $file_arc = $request->file_arc->storeAs('file_arc', $request->file_arc->getClientOriginalName());
        $validate['file_arc'] = $file_arc;

        Release::create($validate);

        return redirect()->route('releases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Release $release
     * @return \Illuminate\Http\Response
     */
    public function show(Release $release)
    {
        return view('releases.show', compact('release'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Release $release
     * @return \Illuminate\Http\Response
     */
    public function edit(Release $release)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Release $release
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Release $release)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Release $release
     * @return \Illuminate\Http\Response
     */
    public function destroy(Release $release)
    {
        abort_if(Gate::denies('release-master'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Storage::delete([$release->file_inst, $release->file_arc]);
        $release->delete();

        return redirect()->route('releases.index');
    }
}
