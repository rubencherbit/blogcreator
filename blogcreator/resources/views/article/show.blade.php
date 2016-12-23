@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                @if($article->user_id !== Auth::id() && Auth::id() !== null && $article->is_share(Auth::id()) === null)
                <div class="panel-heading">{{ $article->title }}<a href="{{url('/article/' . $article->id . '/share')}}" style="float: right !important;">Share this article !</a></div>
                @elseif (Auth::user()->is_follow($article->id) !== null)
                <div class="panel-heading">{{ $article->title }} <span style="float: right !important;">You already share this article !</span></div>
                @else
                <div class="panel-heading">{{ $article->title }}</div>
                @endif
                    <!--<div class="panel-heading">{{ $article->title }}</div>-->
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr><th> Post date </th><td>{{ $article->created_at }}</td></tr>
                                    <tr><th> Categorie </th>
                                        <td>
                                        @if (isset($article->categorie->name))
                                        <a href="{{ url('/categorie/' . $article->categorie->id) }}" title="View Categorie">{{ $article->categorie->name }}</a>
                                        @else
                                        No categorie
                                        @endif
                                        </td>
                                    </tr>
                                    <tr><th> Author </th><td><a href="{{ url('/user/' . $article->user->id) }}" title="View User">{{ $article->user->name }}</a></td></tr>
                                    <tr><th> Description </th><td> {{ $article->description }} </td></tr>
                                    <tr><th> Content </th><td> {{ $article->content }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <ul>
                                @foreach ($attachments as $attachment)
                                <li>
                                {{$attachment->hash}} :
                                <br>
                                @include ('article.show-attachment')
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ url('/blog/'. $curr_blog->id .'/message/create') }}" title="Contact the Author" class="btn btn-success">Contact {{ $article->user->name }} !</a>
                        <div>
                            <h2>Comments</h2>
                            @include ('comment.article-comments')
                        </div>
                        <div>
                            <h2>Post a comment</h2>
                            @if (Auth::guest())
                                <p>Please login to post a comment<p>
                            @else
                                {!! Form::open(['url' => '/comment', 'class' => 'form-horizontal']) !!}
                                @include ('comment.create-form')
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection