<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Comments;

class BlogController extends Controller
{
    public function home()
    {
        $blogPost = BlogPost::where('published', '1')
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();
        return view('home', [
            'posts' => $blogPost,
        ]);
    }

    public function about()
    {
        return view('about', ['currentPage' => 'about']);
    }

    public function contact()
    {
        return view('contact', ['currentPage' => 'contact']);
    }

    public function blogposts()
    {
        $blogsPosts = BlogPost::orderBy('id', 'desc')
            ->get();
        return view('blogposts', [
            'posts' => $blogsPosts,
        ]);
    }

    public function blogPost($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        if ($blogPost->published != 1) {
            return abort(404);
        }
        $comments = Comments::where('blog_post_id', $id)
            ->get();
        return view('blogpost', [
           'post' => $blogPost,
           'comments' => $comments,
        ]);
    }

    /**
     * Store a new comment.
     *
     * @param  Request  $request
     * @return Response
     */
    public function comment(Request $request)
    {
        $validatedData = $request->validate([
            'author' => 'required|max:255',
            'comment_body' => 'required|max:1000',
        ]);

        $comment = new Comments;
        $comment->author = $request->author;
        $comment->comment_body = $request->comment_body;
        $comment->displayed = 1;
        $comment->blog_post_id = $request->blog_post_id;
        $comment->save();
        $value = $request->session()->flash('key', 'Your comment has been submitted');
        return redirect()->route('blogpost', [$comment->blog_post_id]);
    }
}
