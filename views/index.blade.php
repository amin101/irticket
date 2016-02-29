@extends('irticket::layouts.master')
@section('content')
  @include('irticket::partials._alert')
    {{--{!! dd($new_answered_count) !!}--}}
{{--    {!! dd($tickets) !!}--}}
    @if(isset($tickets) && $tickets->count())
    <table class="table table-striped">
        <tr>
        <th>{{ trans('irticket::ticket.index-title') }}</th>
        <th>{{  trans('irticket::ticket.status') }}</th>
        </tr>
        @foreach($tickets as $ticket)
            <tr>
            <td>{!! link_to_route('user.ticket.show',$ticket->title, ['ticket' => $ticket->id]) !!}</td>
            <td>@if($ticket->resolved) {{ trans('irticket::ticket.resolved') }} @else {{ trans('irticket::ticket.open') }} @endif</td>
            </tr>
            @endforeach
    </table>

        {!! $tickets->render() !!}
@else
        <div class="alert alert-info" role="alert">there is no ticket.add a <a href="{{ route('user.ticket.create') }}">new ticket</a></div>

    @endif
    <div class="new-ticket-btn pull-left">
        {!! link_to_route('user.ticket.create',trans('irticket::ticket.new-ticket'),[],['class' => 'btn btn-success btn-large']) !!}
    </div>
    @endsection