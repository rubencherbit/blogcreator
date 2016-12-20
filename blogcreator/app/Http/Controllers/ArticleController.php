<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\Article;
use App\Blog;
use App\Comment;
use Illuminate\Http\Request;
use Session;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'show',
            'index'
            ]
        ]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $article = Article::paginate(25);

        return view('article.index', compact('article'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function indexAdmin()
    {
        $article = Auth::user()->Articles()->paginate(25);

        return view('article.index-admin', compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $blogs = Auth::user()->Blogs()->pluck('title', 'id')->all();

        return view('article.create', compact('blogs'));
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
        $requestData['user_id'] = Auth::id();

        if ($request->hasFile('files')) {
            $uploadPath = public_path('/uploads/');

            $extension = $request->file('files')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request->file('files')->move($uploadPath, $fileName);
            $requestData['files'] = $fileName;
        }
        $blog = Blog::findOrFail($requestData['blog_id']);
        if($blog->user_id !== Auth::id()) {
            return redirect()->route('home');
        } else {
            Article::create($requestData);

            Session::flash('flash_message', 'Article added!');

            return redirect('admin/articles');
        }
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
        $article = Article::findOrFail($id);
        $comments = $article->Comments()->paginate(25);
        $curr_blog = $article->blog;

        return view('article.show', compact('article', 'comments', 'curr_blog'));
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
        $article = Article::findOrFail($id);
        $categories = $article->blog->categories()->pluck('name', 'id')->all();
        array_unshift($categories, 'No categorie');

        if ($article->user_id !== Auth::id()) {
            return redirect()->route('home');
        } else {
            return view('article.edit', compact('article', 'categories'));
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


        if ($request->hasFile('files')) {
            $uploadPath = public_path('/uploads/');

            $extension = $request->file('files')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request->file('files')->move($uploadPath, $fileName);
            $requestData['files'] = $fileName;
        }

        $article = Article::findOrFail($id);
        if ($article->user_id !== Auth::id() || $article->blog->user_id !== Auth::id() ) {
            return redirect()->route('home');
        } else {
            $article->update($requestData);

            Session::flash('flash_message', 'Article updated!');

            return redirect('admin/articles');
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
        $article = Article::findOrFail($id);
        if ($article->user_id !== Auth::id() || $article->blog->user_id !== Auth::id() ) {
            return redirect()->route('home');
        } else {

            Article::destroy($id);

            Session::flash('flash_message', 'Article deleted!');

            return redirect('admin/articles');
        }
    }
}
