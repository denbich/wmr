<?php

namespace App\Http\Controllers\volunteer;

use App\Models\Post;
use App\Models\Signed_form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VPostsController extends Controller
{
    public function list()
    {
        $forms = Signed_form::where('volunteer_id', Auth::user()->id)->pluck('form_id');
        $posts = Post::where('form_id', 0)->orWhereIn('form_id', $forms)->with(['post_translate', 'author'])->get();
        return view('volunteer.posts.list', ['posts' => $posts]);
    }

    public function post($id)
    {
        $post = Post::where('id', $id)->with(['post_translate', 'author', 'd_form'])->first();

        if ($post->form_id == 0)
        {
            return view('volunteer.posts.post', ['post' => $post]);
        } else {
            $forms = Signed_form::where([
                ['volunteer_id', Auth::user()->id],
                ['form_id', $post->form_id]
            ])->first();

            if ($forms != null)
            {
                return view('volunteer.posts.post', ['post' => $post]);
            } else {
                return redirect(route('v.post.list'));
            }
        }
    }
}
