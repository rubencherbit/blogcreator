@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin</div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                Liens
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td><a href="{{ url('/admin/blogs') }}">Administration des blogs</a></td></tr>
                                <tr><td><a href="{{ url('/admin/articles') }}">Administration des articles</a></td></tr>
                                <tr><td><a href="{{ url('/admin/categories') }}">Administration des catégories</a></td></tr>
                                <tr><td><a href="{{ url('/admin/comments') }}">Administration des commentaires</a></td></tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection