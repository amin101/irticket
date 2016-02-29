{!! Form::open(['route' => ['user.ticket.update', 'ticket' => $ticket_id], 'method' => 'put']) !!}

<div class="form-group">
  {!! Form::textarea('content',null,['class' => 'form-control']) !!}
</div>

<input type="submit" name="submit" class="btn btn-primary" value="{{ trans('user/ticket/show.submit') }}">
<input type="submit" name="close_issue" class="btn btn-danger" value="{{ trans('user/ticket/show.close_issue') }}">
{!! Form::close() !!}