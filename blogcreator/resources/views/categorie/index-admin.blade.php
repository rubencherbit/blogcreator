@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>
                    <div class="panel-body">

                        <a href="{{ url('/categorie/create') }}" class="btn btn-primary btn-xs" title="Add New Categorie"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Blog </th>
                                        <th> Name </th>
                                        <th> Description </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($categorie as $item)
                                    <tr>
                                        <td><a href="{{ url('/blogs/' . $item->blog->id) }}">{{ $item->blog->title }}</a></td>
                                        <td><a href="{{ url('/categorie/' . $item->id) }}">{{ $item->name }}</a></td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a href="{{ url('/categorie/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Categorie"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/categorie', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Categorie" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Categorie',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $categorie->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection