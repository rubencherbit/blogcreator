@extends('layouts.master')

@section('title', 'Login')

@section('main-content')
@parent
<h2>Login</h2>

<div>
@if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
@endif

{!! Form::open(['action' => 'login']) !!}

{!! Form::label('username', 'Username : ') !!}
{!! Form::text('username') !!}
<br>
{!! Form::label('password', 'Password : ') !!}
{!! Form::password('password') !!}
<br>
{!! Form::submit('Login !') !!}
{!! Form::close() !!}
</div>

@endsection