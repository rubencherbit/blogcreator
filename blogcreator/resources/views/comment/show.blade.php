@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Comment by <a href="{{ url('/user/' . $comment->user->id) }}" title="View User">{{ $comment->user->name }}</a></div>
                    <div class="panel-body">

                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['comment', $comment->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Comment',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th> Content </th>
                                        <td> {{ $comment->content }} </td>
                                    </tr>
                                    <tr>
                                        <th> Author </th>
                                        <td><a href="{{ url('/user/' . $comment->user->id) }}" title="View User">{{ $comment->user->name }}</a></td>
                                    </tr>
                                    <tr>
                                        <th> Blog </th>
                                        <td><a href="{{ url('/blogs/' . $comment->article->blog->id) }}" title="View Blog">{{ $comment->article->blog->title }}</a></td>
                                    </tr>
                                    <tr>
                                        <th> Article </th>
                                        <td><a href="{{ url('/article/' . $comment->article->id) }}" title="View Article">{{ $comment->article->title }}</a></td>
                                    </tr>
                                    <tr>
                                        <th> Date </th>
                                        <td> {{ $comment->created_at }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection