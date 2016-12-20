@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Categorie</div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Blog Id </th><th> Name </th><th> Description </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($categorie as $item)
                                    <tr>
                                        <td>{{ $item->blog_id }}</td><td>{{ $item->name }}</td><td>{{ $item->description }}</td>
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