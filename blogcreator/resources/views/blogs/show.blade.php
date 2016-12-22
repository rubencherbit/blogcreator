@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $curr_blog->title }}</div>
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