{{--USER show ticket page--}}
@extends('user.layout.master')
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
                    {{ trans('user/ticket/show.created_by') }} {{ $root->user->name }}
                    {{ trans('user/ticket/show.on') }} {{ jDate::forge($root->created_at->timestamp)->format('datetime') }}
                </small>
            </div>
        </div>
        @if($children)
            @foreach($children as $ticket)

                <div class="panel panel-default">
                    <div class="panel-body">{{ $ticket->content }}</div>
                    <div class="panel-footer text-left">
                        <small>
                            {{ trans('user/ticket/show.created_by') }} {{ $ticket->user->name }}
                            {{ trans('user/ticket/show.on') }} {{ jDate::forge($ticket->created_at->timestamp)->format('datetime') }}
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