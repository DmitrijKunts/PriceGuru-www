<?php

namespace App\Http\Controllers;

use App\Models\Release;
use App\Models\ReleaseComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class ReleaseCommentController extends Controller
{
    public function create($version)
    {
        $user_id = Auth::user()->id;
        $release = Release::where('version', $version)->first();
        return view('comments.create', compact('release', 'user_id'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|integer',
            'release_id' => 'required|integer',
        ]);

        $c = ReleaseComment::create($validate);

        $validate['content'] = $validate['message'];
        unset($validate['message']);
        $validate['c'] = $c;
        $validate['url'] = route('releases.show', [$c->release]);
        Mail::send('mail.new_comment', $validate, function ($message) use ($c) {
            $message->from(Auth::user()->email);
            $message->to(config('mail.contactAddress', "admin@admin.net"))
                ->subject('Новый комментарий на сайте Price-Guru', $c->user->name);
        });

        return redirect()->route('releases.show', [$c->release]);
    }

    public function destroy(ReleaseComment $comment)
    {
        abort_if(Gate::denies('comments-edit', $comment), 403, '403 Forbidden');

        $comment->delete();
        return redirect()->route('releases.show', $comment->release);
    }
}
