<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\Article;
use App\Blog;
use App\Comment;
use App\Attachment;
use Illuminate\Http\Request;
use Session;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'show',
            'index',
            'getByYear',
            'getByMonth',
            ]
        ]);

    }
    public function share_article($id)
    {
        if(Auth::id() !== null) {
            $article = Article::findOrFail($id);
            if($article->user_id !== Auth::id()) {
                Auth::user()->shared_articles()->syncWithoutDetaching([$id]);
                Session::flash('flash_message', 'Article shared!');
                return  redirect()->action(
                    'ArticleController@show', ['id' => $id]
                    );
            } else {
                Session::flash('flash_error', 'nop nop nop');
                return  redirect()->route('/');
            }
        } else {
            Session::flash('flash_error', 'nop nop nop');
            return  redirect()->route('/');
        }

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

        $blog = Blog::findOrFail($requestData['blog_id']);
        if($blog->user_id !== Auth::id()) {
            Session::flash('flash_error', 'You don\'t have the permissions to see this page !');
            return redirect()->route('home');
        } else {
            $article = Article::create($requestData);

            if ($request->hasFile('attachments')) {
                $article->proceedAttachments($request->file('attachments'));
            }

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
        $attachments = $article->attachments;
        $comments = $article->Comments()->paginate(25);
        $curr_blog = $article->blog;

        return view('article.show', compact('article', 'attachments', 'comments', 'curr_blog'));
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
        $attachments = $article->attachments;
        $categories = $article->blog->categories()->pluck('name', 'id')->all();
        $categories[0] = 'No categorie';

        if ($article->user_id !== Auth::id()) {
            Session::flash('flash_error', 'You don\'t have the permissions to see this page !');
            return redirect()->route('home');
        } else {
            return view('article.edit', compact('article', 'attachments','categories'));
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

        $article = Article::findOrFail($id);
        if ($article->user_id !== Auth::id() || $article->blog->user_id !== Auth::id() ) {
            Session::flash('flash_error', 'You don\'t have the permissions to see this page !');
            return redirect()->route('home');
        } else {
            $article->update($requestData);

            if ($request->hasFile('attachments')) {
                $article->proceedAttachments($request->file('attachments'));
            }

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
            Session::flash('flash_error', 'You don\'t have the permissions to see this page !');
            return redirect()->route('home');
        } else {

            Article::destroy($id);

            Session::flash('flash_message', 'Article deleted!');

            return redirect('admin/articles');
        }
    }


    public function destroyAttachment($id)
    {
        $attachment = Attachment::findOrFail($id);
        $user = Auth::user();

        if ($attachment->article->user_id == $user->id) {
            $attachment->delete();

            return redirect()->route('article.edit', $attachment->article_id);
        } else {
            Session::flash('flash_error', 'You don\'t have the permissions to see this page !');
            return redirect()->route('home');
        }
    }

    public function getByYear($blog_id, $year)
    {
        $curr_blog = Blog::findOrFail($blog_id);
        $articles = $curr_blog->articles()->whereYear('created_at', '=', $year)->get();
        $date = $year;

        return view('article.list-by', compact('curr_blog', 'articles', 'date'));
    }

    public function getByMonth($blog_id, $month)
    {
        $curr_blog = Blog::findOrFail($blog_id);
        $articles = $curr_blog->articles()->whereDate('created_at', 'LIKE', $month . '-%')->get();
        $date = $month;

        return view('article.list-by', compact('curr_blog', 'articles', 'date'));
    }
}
