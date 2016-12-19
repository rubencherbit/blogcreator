<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use Illuminate\Http\Request;
use Session;

class ArticleController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('article.create');
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


        if ($request->hasFile('files')) {
            $uploadPath = public_path('/uploads/');

            $extension = $request->file('files')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request->file('files')->move($uploadPath, $fileName);
            $requestData['files'] = $fileName;
        }

        Article::create($requestData);

        Session::flash('flash_message', 'Article added!');

        return redirect('article');
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

        return view('article.show', compact('article'));
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

        return view('article.edit', compact('article'));
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
        $article->update($requestData);

        Session::flash('flash_message', 'Article updated!');

        return redirect('article');
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
        Article::destroy($id);

        Session::flash('flash_message', 'Article deleted!');

        return redirect('article');
    }
}
