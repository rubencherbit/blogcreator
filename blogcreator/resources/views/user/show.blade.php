@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">User {{ $user->name }}</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Email</th><td>{{ $user->email }}</td>
                                    </tr>
                                    <tr><th> Name </th><td><a href="{{ url('/user/' . $user->id) }}" title="View User">{{ $user->name }}</a></td></tr>
                                </tbody>
                            </table>
                        </div>

                        @if (Auth::id() == $user->id)
                        @include ('user.news-feed')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection