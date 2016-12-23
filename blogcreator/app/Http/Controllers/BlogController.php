<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\Blog;
use Illuminate\Http\Request;
use Session;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'show',
            'index'
            ]
        ]);

    }
    public function follow_blogs()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $blog = Blog::paginate(25);

        return view('blogs.index', compact('blog'));
    }

    /**
     * Display a listing of the resource for the admin.
     *
     * @return \Illuminate\View\View
     */
    public function indexAdmin()
    {
        $blog = Auth::user()->Blogs()->paginate(25);

        return view('blogs.index-admin', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('blogs.create');
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
        if ($request->hasFile('banner')) {
            $uploadPath = public_path('/uploads/banners/');

            $extension = $request->file('banner')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request->file('banner')->move($uploadPath, $fileName);
            $requestData['banner'] = $fileName;
        }

        Blog::create($requestData);

        Session::flash('flash_message', 'Blog added!');

        return redirect('admin/blogs');
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
        $curr_blog = Blog::findOrFail($id);
        $articles = $curr_blog->articles;
        $categories = $curr_blog->categories;
        $years = $curr_blog->years();
        $months = $curr_blog->months();

        return view('blogs.show', compact('curr_blog', 'articles', 'categories', 'years', 'months'));
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
        $blog = Blog::findOrFail($id);
        if ($blog->user_id !== Auth::id()) {
            Session::flash('flash_error', 'You don\'t have the permissions to see this page !');
            return redirect()->route('home');
        } else {
            return view('blogs.edit', compact('blog'));
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


        if ($request->hasFile('banner')) {
            $uploadPath = public_path('/uploads/banners/');

            $extension = $request->file('banner')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request->file('banner')->move($uploadPath, $fileName);
            $requestData['banner'] = $fileName;
        }

        $blog = Blog::findOrFail($id);
        if ($blog->user_id !== Auth::id()) {
            Session::flash('flash_error', 'You don\'t have the permissions to see this page !');
            return redirect()->route('home');
        } else {
            $blog->update($requestData);

            Session::flash('flash_message', 'Blog updated!');

            return redirect('admin/blogs');
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
        $blog = Blog::findOrFail($id);
        if ($blog->user_id !== Auth::id()) {
            Session::flash('flash_error', 'You don\'t have the permissions to see this page !');
            return redirect()->route('home');
        } else {
            Blog::destroy($id);

            Session::flash('flash_message', 'Blog deleted!');

            return redirect('admin/blogs');
        }
    }
}
