@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Message for you : {{ $message->title }}</div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Sender</th>
                                        <td>{{ $message->sender->name }}</td>
                                    </tr>
                                    <tr>
                                        <th> Date </th>
                                        <td> {{ $message->created_at }} </td>
                                    </tr>
                                    <tr>
                                        <th> Title </th>
                                        <td> {{ $message->title }} </td>
                                    </tr>
                                    <tr>
                                        <th> Content </th>
                                        <td> {{ $message->content }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection