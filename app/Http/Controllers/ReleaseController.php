<?php

namespace App\Http\Controllers;

use App\Models\Release;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ReleaseController extends Controller
{
    public function index()
    {
        $releases = Release::orderBy('created_at', 'desc')->get();
        return view('releases.index', compact('releases'));
    }

    public function create()
    {
        abort_if(Gate::denies('release-master'), 403, '403 Forbidden');

        return view('releases.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('release-master'), 403, '403 Forbidden');

        $validate = $request->validate([
            'version' => 'required|digits_between:1,999999|unique:releases',
            'description' => 'required',
            'file_inst' => 'required|file|max:99999999',
            'file_arc' => 'required|file|max:99999999',
        ]);


        $file_inst = Storage::putFileAs('file_inst', $request->file('file_inst'), $request->file('file_inst')->getClientOriginalName());
        $validate['file_inst'] = $file_inst;

        $file_arc = $request->file_arc->storeAs('file_arc', $request->file_arc->getClientOriginalName());
        $validate['file_arc'] = $file_arc;

        Release::create($validate);

        return redirect()->route('releases.index');
    }

    public function show(Release $release)
    {
        return view('releases.show', compact('release'));
    }

    public function edit(Release $release)
    {
        abort_if(Gate::denies('release-master'), 403, '403 Forbidden');

        return view('releases.edit', compact('release'));
    }

    public function update(Request $request, Release $release)
    {
        abort_if(Gate::denies('release-master'), 403, '403 Forbidden');

        $validate = $request->validate([
            'version' => ['required', 'digits_between:1,999999', Rule::unique('releases')->ignore($release->id)],
            'description' => 'required',
            'file_inst' => 'file|max:99999999',
            'file_arc' => 'file|max:99999999',
        ]);

        if (isset($validate['file_inst'])) {
            $file_inst = $request->file_inst->storeAs('file_inst', $request->file_inst->getClientOriginalName());
            $validate['file_inst'] = $file_inst;
        }

        if (isset($validate['file_arc'])) {
            $file_arc = $request->file_arc->storeAs('file_arc', $request->file_arc->getClientOriginalName());
            $validate['file_arc'] = $file_arc;
        }

        $release->update($validate);

        return redirect()->route('releases.show', $release);
    }

    public function destroy(Release $release)
    {
        abort_if(Gate::denies('release-master'), 403, '403 Forbidden');

        Storage::delete([$release->file_inst, $release->file_arc]);
        $release->delete();

        return redirect()->route('releases.index');
    }
}
