@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Comments</div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Content </th>
                                        <th> Author </th>
                                        <th> Blog </th>
                                        <th> Article </th>
                                        <th> Date </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($comment as $item)
                                    <tr>
                                        <td>{{ $item->content }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td><a href="{{ url('/blogs/' . $item->article->blog->id) }}" title="View Blog">{{ $item->article->blog->title }}</a></td>
                                        <td><a href="{{ url('/article/' . $item->article->id) }}" title="View Article">{{ $item->article->title }}</a></td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ url('/comment/' . $item->id) }}" class="btn btn-success btn-xs" title="View Comment"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/comment', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Comment" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Comment',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $comment->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection