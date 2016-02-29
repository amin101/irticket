@extends('admin.layout.master')
@section('content')
{{--    {!! dd($tickets) !!}--}}
    <table class="table table-striped">
       <tr>
        <th>title</th>
        <th>user</th>
        <th>updated at</th>
       <th>delete</th>

       </tr>
   @foreach($tickets as $ticket)
       <tr>
        <td>{!! link_to_route('admin.ticket.show', $ticket->title,['ticket'  => $ticket->id]) !!}</td>
       <td>{{ $ticket->user_id }}</td>
       <td>{{ $ticket->created_at }}</td>
           <td>
               {!! Form::open(['method' => 'delete', 'route' => ['admin.ticket.destroy', 'ticket' => $ticket->id]]) !!}
               <button type="submit" class="no-btn">
                   <i class="fa fa-trash-o"></i>
               </button>
               {!! Form::close() !!}
           </td>
       </tr>
    @endforeach
    </table>
    @endsection