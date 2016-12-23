@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

            @if($curr_blog->user_id !== Auth::id() && Auth::id() !== null && Auth::user() !== null)
                @if (Auth::user()->is_follow($curr_blog->id) === null)
                <div class="panel-heading">{{ $curr_blog->title }}<a href="{{url('/follow_blog/' . $curr_blog->id)}}" style="float: right !important;">Suivre ce blog !</a></div>
                @elseif (Auth::user()->is_follow($curr_blog->id) !== null)
                    <div class="panel-heading">{{ $curr_blog->title }} <span style="float: right !important;">Tu suis déjà ce blog !</span></div>
                @endif
            @else
                <div class="panel-heading">{{ $curr_blog->title }}</div>
            @endif
                <div class="panel-body">

                    @include ('article.list')

                    @include ('categorie.list')

                    @include ('article.list-date')

                    <a href="{{ url('/blog/'. $curr_blog->id .'/message/create') }}" title="Contact the Author" class="btn btn-success">Contact {{ $curr_blog->user->name }} !</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection