<?php

namespace App\Http\Controllers;

use App\Models\Release;
use App\Models\ReleaseComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReleaseCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Release $release)
    {
        dd($release);
        return '111';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Release $release)
    {
        if (!Auth::check()) {
            abort(403);
        }
        $user_id = Auth::user()->id;
        return view('comments.create', compact('release', 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            abort(403);
        }
        $validate = $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|integer',
            'release_id' => 'required|integer',
        ]);

        ReleaseComment::create($validate);

        return redirect()->route('releases.show', [$validate['release_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ReleaseComment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(ReleaseComment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ReleaseComment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(ReleaseComment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ReleaseComment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReleaseComment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ReleaseComment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReleaseComment $comment)
    {
        if (Auth::user()->id != $comment->user->id) {
            abort(403);
        }
        $comment->delete();

        return redirect()->route('releases.show', $comment->release);
    }
}
