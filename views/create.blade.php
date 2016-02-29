{{--user create ticket page--}}
@extends('irticket::layouts.master')

@section('content')
@include('irticket::forms._new_ticket_form')
    @endsection