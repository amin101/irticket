@extends('irticket::layouts.master')
@section('content')
    @if(isset($root))
        <div class="panel panel-warning">
            <div class="panel-heading"><span class="badge pull-left">@if($root->category) {{ $root->category->name }} @endif</span><h3 class="panel-title">{{ $root->title }}</h3></div>
            <div class="panel-body">{{ $root->content }}</div>
            <div class="panel-footer text-left"><small>{{ trans('irticket::ticket.created_by') }} {{ $root->user->name }} {{ trans('irticket::ticket.on') }} {{ $root->created_at }}</small></div>
        </div>
        @if($children)
        @foreach($children as $ticket)
{{--{!! dd($ticket) !!}--}}
            <div class="panel panel-default">
                <div class="panel-body">{{ $ticket->content }}</div>
                <div class="panel-footer text-left"><small>created by {{ $ticket->user->name }} on {{ $ticket->created_at }}</small></div>
            </div>
        @endforeach
        @endif
        @include('irticket::backend.forms.reply_form',['form_type' => 'show', 'ticket_id' => $root->id])
    @endif

    @endsection