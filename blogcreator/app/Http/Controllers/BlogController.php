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
            'show'
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
        $blog = Auth::user()->Blogs()->paginate(25);

        return view('blogs.index', compact('blog'));
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
            $uploadPath = public_path('/uploads/');

            $extension = $request->file('banner')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request->file('banner')->move($uploadPath, $fileName);
            $requestData['banner'] = $fileName;
        }

        Blog::create($requestData);

        Session::flash('flash_message', 'Blog added!');

        return redirect('blogs');
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
        $blog = Blog::findOrFail($id);

        return view('blogs.show', compact('blog'));
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
            $uploadPath = public_path('/uploads/');

            $extension = $request->file('banner')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request->file('banner')->move($uploadPath, $fileName);
            $requestData['banner'] = $fileName;
        }

        $blog = Blog::findOrFail($id);
        if ($blog->user_id !== Auth::id()) {
            return redirect()->route('home');
        } else {
            $blog->update($requestData);

            Session::flash('flash_message', 'Blog updated!');

            return redirect('blogs');
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
            return redirect()->route('home');
        } else {
            Blog::destroy($id);

            Session::flash('flash_message', 'Blog deleted!');

            return redirect('blogs');
        }
    }
}
