{{--user show ticket page--}}
@extends('irticket::layouts.master')
@section('content')
    @if($root)
        <div class="panel panel-warning">
            <div class="panel-heading">
                <span class="badge pull-left">
                    @if($root->category){{ $root->category->name }} @endif
                </span>
                <h3 class="panel-title">{{ $root->title }}</h3>
            </div>
            <div class="panel-body">{{ $root->content }}</div>
            <div class="panel-footer text-left">
                <small>
                    {{ trans('irticket::ticket.created_by') }} {{ $root->user->name }}
                    {{ trans('irticket::ticket.on') }} {{ jDate::forge($root->created_at->timestamp)->format('datetime') }}
                </small>
            </div>
        </div>
        @if($children)
            @foreach($children as $ticket)

                <div class="panel panel-default">
                    <div class="panel-body">{{ $ticket->content }}</div>
                    <div class="panel-footer text-left">
                        <small>
                            {{ trans('irticket::ticket.created_by') }} {{ $ticket->user->name }}
                            {{ trans('irticket::ticket.on') }} {{ jDate::forge($ticket->created_at->timestamp)->format('datetime') }}
                        </small>
                    </div>
                </div>
            @endforeach
        @endif
        @if(! $root->resolved)
            @include('user.ticket.forms._reply_form',[ 'ticket_id' => $root->id])
        @endif
    @endif
@endsection