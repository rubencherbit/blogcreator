@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Article {{ $article->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('article/' . $article->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Article"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['article', $article->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Article',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $article->id }}</td>
                                    </tr>
                                    <tr><th> Blog Id </th><td> {{ $article->blog_id }} </td></tr><tr><th> Title </th><td> {{ $article->title }} </td></tr><tr><th> Description </th><td> {{ $article->description }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                        @if (Auth::guest())
                            <p>Please login to post a comment<p>
                        @else
                        {!! Form::open(['url' => '/comment', 'class' => 'form-horizontal']) !!}
                        <h2>Post a comment</h2>
                        @include ('comment.create-form')

                        {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection