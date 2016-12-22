@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Articles</div>
                    <div class="panel-body">

                        <a href="{{ url('/article/create') }}" class="btn btn-primary btn-xs" title="Add New Article"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Blog </th>
                                        <th> Title </th>
                                        <th> Description </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($article as $item)
                                    <tr>
                                        <td><a href="{{ url('/blogs/' . $item->blog_id) }}">{{ $item->blog->title }}</a></td>
                                        <td><a href="{{ url('/article/' . $item->id) }}">{{ $item->title }}</a></td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a href="{{ url('/article/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Article"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/article', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Article" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Article',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
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