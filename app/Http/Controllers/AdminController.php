<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Comments;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function displayAllBlogPostsInAdmin()
    {
        $blogPost = BlogPost::orderBy('id', 'DESC')
            ->simplePaginate(10);

        return view('admin.all_blogs_admin', [
            'blogPost' => $blogPost,
        ]);
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->action('LoginController@login')->with('message', 'Your are now logged out!');
        ;
    }

    public function createBlogPost()
    {
        return view('admin.edit_blog_admin', [
            'isNew' => true,
            'title' => null,
            'body' => null,
            'published' => null,
            'id'=>null,
        ]);
    }

    public function saveBlogPost(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
        ]);

        $blog = new BlogPost;
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->published = $request->published;
        $blog->save();
        $value = $request->session()->flash('key', 'Your blog Post has been submitted');
        return redirect()->action('AdminController@displayAllBlogPostsInAdmin');
    }

    public function editBlogPost($id)
    {
        $blog = BlogPost::findOrFail($id);

        return view('admin.edit_blog_admin', [
            'isNew' => false,
            'title' => $blog['title'],
            'body' => $blog['body'],
            'published' => $blog['published'],
            'id' => $id,
        ]);
    }

    public function updateBlogPost(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:5000',
        ]);

        $id = $request->id;

        $blog = BlogPost::findOrFail($id);
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->published = $request->published;
        $blog->save();
        $value = $request->session()->flash('key', 'Your blog Post has been updated');
        return redirect()->action('AdminController@displayAllBlogPostsInAdmin');
    }

    public function deleteBlogPost(Request $request)
    {
        $id = $request->id;
        $blog = BlogPost::find($id);
        $blog->delete();
        $value = $request->session()->flash('key', 'Your blog Post has been deleted');
        return redirect()->action('AdminController@displayAllBlogPostsInAdmin');
    }

    public function destroyBlogPost($id)
    {
        return view('admin.delete_blog_admin', [
            'id' => $id,
        ]);
    }

    public function displayAllCommentsInAdmin()
    {
        $comment = Comments::orderBy('id', 'DESC')
            ->simplePaginate(10);
        return view('admin.comments_admin', [
            'comment' => $comment,
        ]);
    }

    public function deleteComment(Request $request)
    {
        $id = $request->id;
        $comment = Comments::find($id);
        $comment->delete();
        $value = $request->session()->flash('key', 'Your Comment has been deleted');
        return redirect()->action('AdminController@displayAllCommentsInAdmin');
    }

    public function destroyComment($id)
    {
        return view('admin.delete_comments', [
            'id' => $id,
        ]);
    }
}
