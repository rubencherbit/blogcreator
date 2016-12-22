<div class="form-group {{ $errors->has('receiver') ? 'has-error' : ''}}">
    {!! Form::label('receiver', 'Receiver', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('receiver', $receiver->name, ['class' => 'form-control', 'readonly']) !!}
        {!! Form::hidden('receiver_id', $receiver->id, ['class' => 'form-control']) !!}
        {!! Form::hidden('blog_id', $curr_blog->id, ['class' => 'form-control']) !!}
        {!! $errors->first('receiver', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Content', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>