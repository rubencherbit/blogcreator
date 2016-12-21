<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\Categorie;
use Illuminate\Http\Request;
use Session;

use App\Blog;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'index',
            'show'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categorie = Categorie::paginate(25);

        return view('categorie.index', compact('categorie'));
    }

    public function indexAdmin()
    {
        $categorie = Auth::user()->Categories()->paginate(25);

        return view('categorie.index-admin', compact('categorie'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $blogs = Auth::user()->Blogs()->pluck('title', 'id')->all();

        return view('categorie.create', compact('blogs'));
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
        $blog = Blog::findOrFail($requestData['blog_id']);

        if($blog->user_id !== Auth::id()) {
            return redirect()->route('home');
        } else {
            Categorie::create($requestData);

            Session::flash('flash_message', 'Categorie added!');

            return redirect('admin/categories');
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
        $categorie = Categorie::findOrFail($id);

        return view('categorie.show', compact('categorie'));
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
        $categorie = Categorie::findOrFail($id);
        $blogs = Auth::user()->Blogs()->pluck('title', 'id')->all();

        if($categorie->blog->user_id !== Auth::id()) {
            return redirect()->route('home');
        } else {
            return view('categorie.edit', compact('categorie', 'blogs'));
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

        $categorie = Categorie::findOrFail($id);

        if($categorie->blog->user_id !== Auth::id()) {
            return redirect()->route('home');
        } else {
            $categorie->update($requestData);

            Session::flash('flash_message', 'Categorie updated!');

            return redirect('admin/categories');
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
        $categorie = Categorie::findOrFail($id);
        if($categorie->blog->user_id !== Auth::id()) {
            return redirect()->route('home');
        } else {
            Categorie::destroy($id);

            Session::flash('flash_message', 'Categorie deleted!');

            return redirect('admin/categories');
        }
    }
}
