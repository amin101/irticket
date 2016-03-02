@extends('irticket::layouts.master')
@section('content')
{{--    {!! dd($tickets) !!}--}}
    <table class="table table-striped">
       <tr>
        <th>{{ trans('irticket::ticket.title') }}</th>
        <th>{{ trans('irticket::ticket.user') }}</th>
        <th>{{ trans('irticket::ticket.updated-at') }}</th>
       <th>{{ trans('irticket::ticket.delete') }}</th>

       </tr>
   @foreach($tickets as $ticket)
       <tr>
        <td>{!! link_to_route('admin.tickets.show', $ticket->title,['ticket'  => $ticket->id]) !!}</td>
       <td>{{ $ticket->user_id }}</td>
       <td>{{ $ticket->created_at }}</td>
           <td>
               {!! Form::open(['method' => 'delete', 'route' => ['admin.tickets.destroy', 'ticket' => $ticket->id]]) !!}
               <button type="submit" class="no-btn">
                   <span class="glyphicon glyphicon-trash"></span>
               </button>
               {!! Form::close() !!}
           </td>
       </tr>
    @endforeach
    </table>
    @endsection