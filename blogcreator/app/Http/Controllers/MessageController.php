<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Blog;
use Auth;

use App\Message;
use Illuminate\Http\Request;
use Session;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $message = Auth::user()->receivedMessages()->paginate(25);

        return view('message.index', compact('message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($blog_id)
    {
        $curr_blog = Blog::findOrFail($blog_id);
        $receiver = $curr_blog->user;

        return view('message.create', compact('curr_blog', 'receiver'));
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

        $user = Auth::user();
        $blog_id = $requestData['blog_id'];
        unset($requestData['receiver']);
        unset($requestData['blog_id']);

        $requestData['sender_id'] = $user->id;
        $requestData['is_read'] = 0;
        Message::create($requestData);

        Session::flash('flash_message', 'Message added!');

        return redirect()->route('blogs.show', ['id' => $blog_id]);

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
        $user = Auth::user();
        $message = Message::findOrFail($id);

        if ($message->receiver->id !== $user->id) {
            return redirect()->route('home');
        } else {
            $message->markAsRead();
            return view('message.show', compact('message'));
        }
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
        $message = Message::findOrFail($id);

        return view('message.edit', compact('message'));
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

        $message = Message::findOrFail($id);
        $message->update($requestData);

        Session::flash('flash_message', 'Message updated!');

        return redirect('message');
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
        Message::destroy($id);

        Session::flash('flash_message', 'Message deleted!');

        return redirect('message');
    }
}
