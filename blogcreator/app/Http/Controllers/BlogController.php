<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Auth::user()->Blogs()->paginate(25);

        return view('blogs.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
     * @return \Illuminate\Http\Response
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
