<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
            $user = Auth::user();

            return view('user.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view('user.create');
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

        // $requestData = $request->all();

        // User::create($requestData);

        // Session::flash('flash_message', 'User added!');

        // return redirect('user');
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
        $user = User::findOrFail($id);
        $followedBlogs = $user->follow_blogs;

        $articles = [];
        foreach($followedBlogs as $blog) {
            foreach($blog->articles as $article) {
                array_push($articles, $article);
            }
        }
        usort($articles, function($a, $b)
        {
            return strcmp($a->created_at, $b->created_at);
        });

        return view('user.show', compact('user', 'articles'));
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
        $user = Auth::user();
        if($id != $user->id) {
            Session::flash('flash_error', 'You don\'t have the permissions to see this page !');
            return redirect()->route('home');
        } else {
            return view('user.edit', compact('user'));
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
        if($id != Auth::id()) {
            Session::flash('flash_error', 'You don\'t have the permissions to see this page !');
            return redirect()->route('home');
        } else {
            $user = Auth::user();
            $user->update($requestData);

            Session::flash('flash_message', 'User updated!');

            return redirect('/admin');
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
        // if($id != Auth::id()) {
        //     return redirect()->route('home');
        // } else {

        //     User::destroy($id);

        //     Session::flash('flash_message', 'User deleted!');

        //     return redirect('user');
        // }
    }
}
