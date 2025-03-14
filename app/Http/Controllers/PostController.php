<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Mostra un singolo post
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    // Aggiorna/Modifica un post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('post.show', ['post' => $post->id])
                         ->with('success', 'Post aggiornato con successo');
    }

    // Cancella un post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post eliminato con successo');
    }
}
