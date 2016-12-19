@extends('layouts.master')

@section('title', 'Register')

@section('main-content')
@parent
<h2>Register</h2>

<div>
@if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
@endif

{!! Form::open(['route' => 'register']) !!}

{!! Form::label('username', 'Username : ') !!}
{!! Form::text('username') !!}
<br>
{!! Form::label('password', 'Password : ') !!}
{!! Form::password('password') !!}
<br>
{!! Form::label('email', 'Email : ') !!}
{!! Form::email('email') !!}
<br>
{!! Form::submit('Register !') !!}
{!! Form::close() !!}
</div>

@endsection