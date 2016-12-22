@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Blogs</div>
                    <div class="panel-body">

                        <a href="{{ url('/blogs/create') }}" class="btn btn-primary btn-xs" title="Add New Blog"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Title </th>
                                        <th> Description </th>
                                        <th> Banner </th>
                                        <th>Nb articles</th>
                                        <th>Nb coms</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($blog as $item)
                                    <tr>
                                        <td><a href="{{ url('/blogs/' . $item->id) }}" title="View Blog">{{ $item->title }}</a></td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            {{ Html::image('uploads/banners/' . $item->banner, 'Bannière', ['class' => 'banner']) }}
                                        </td>
                                        <td>{{ $item->articles->count() }}</td>
                                        <td>{{ $item->comments->count() }}</td>
                                        <td>
                                            <a href="{{ url('/blogs/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Blog"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/blogs', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Blog" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Blog',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
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