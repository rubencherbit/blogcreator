@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Blogs</div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Title </th><th> Description </th><th> Banner </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($blog as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td><td>{{ $item->description }}</td><td>{{ $item->banner }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $blog->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection