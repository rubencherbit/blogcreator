@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Articles</div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Blog Id </th><th> Title </th><th> Description </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($article as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->blog_id }}</td><td>{{ $item->title }}</td><td>{{ $item->description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $article->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection