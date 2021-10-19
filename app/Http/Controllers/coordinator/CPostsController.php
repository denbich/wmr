<?php

namespace App\Http\Controllers\coordinator;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Translate_post;
use App\Models\Translate_prize;
use Illuminate\Support\Facades\Auth;

class CPostsController extends Controller
{
    public function index()
    {
        $posts = Post::with(['post_translate', 'author'])->get();
        return view('coordinator.posts.list', ['posts' => $posts]);
    }

    public function create()
    {
        $forms = Form::with('form_translate')->get();
        return view('coordinator.posts.create', ['forms' => $forms]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        if ($request->post_type == "type_general")
        {
            $form_id = $request->form_select;
        } else {
            $form_id = 0;
        }

        $post = Post::create([
            'form_id' => $form_id,
            'author_id' => Auth::id(),
        ]);

        $t_post = Translate_post::create([
            'post_id' => $post->id,
            'locale' => $request->locale,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect(route('c.post.show', [$post->id]))->with(['created_post' => true]);
    }


    public function show($id)
    {
        $post = Post::where('id', $id)->with(['post_translate', 'author', 'd_form'])->first();
        return view('coordinator.posts.show', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->with(['post_translate'])->first();
        return view('coordinator.posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Translate_post::where('id', $id);
        $post->fill([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        $post->save();

        return redirect(route('c.post.edit', [$post->post_id]))->with(['edited_post' => true]);
    }

    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect(route('c.post.list'))->with(['delete_post' => true]);
    }
}
