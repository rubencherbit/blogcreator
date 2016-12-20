<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Comment;
use Illuminate\Http\Request;
use Session;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $comment = Comment::paginate(25);

        return view('comment.index', compact('comment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('comment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $article = Article::findOrFail($requestData['article_id']);

        Comment::create($requestData);

        Session::flash('flash_message', 'Comment added!');

        return redirect('comment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        if($comment->blog->user_id === Auth::id()) {
            return redirect()->route('home');
        } else {
            return view('comment.edit', compact('comment'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $requestData = $request->all();

        $comment = Comment::findorfail($id);
        if($comment->blog->user_id === Auth::id()) {
            return redirect()->route('home');
        } else {
            $comment->update($requestData);

            Session::flash('flash_message', 'Comment updated!');

            return redirect('comment');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $comment = Comment::findorfail($id);
        if($comment->blog->user_id === Auth::id() || $comment->user_id === Auth::id()) {
            return redirect()->route('home');
        } else {
            Comment::destroy($id);

            Session::flash('flash_message', 'Comment deleted!');

            return redirect('comment');
        }
    }
}
