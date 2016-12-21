@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Article {{ $article->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($article, [
                            'method' => 'PATCH',
                            'url' => ['/article', $article->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('article.edit-form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                        <div>
                            <ul>
                                @foreach ($attachments as $attachment)
                                <li>
                                {{$attachment->hash}} :
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['article/destroy-attachment', $attachment->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Attachment" />', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Delete Attachment',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                                {!! Form::close() !!}
                                <br>
                                @include ('article.show-attachment')
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection