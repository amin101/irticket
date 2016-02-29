{!! Form::open(['route' => 'user.ticket.store', 'method' => 'post']) !!}
<div class="form-group {{ addErrorClass($errors, 'title') }}">
    {!! Form::text('title',null,
    ['class' => 'form-control', 'id' => "title", 'placeholder' => trans('user/ticket/create.title')]) !!}
    {!! InputErrorMessage($errors, 'title') !!}
</div>

<div class="form-group">
    {!! Form::textarea('content',null,['class' => 'form-control']) !!}
</div>


<input type="submit" name="submit" class="btn btn-primary" value="{{ trans('user/ticket/create.submit') }}">
{!! Form::close() !!}