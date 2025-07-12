@extends('layouts.app')

@section('content')
    <div class="container py-5 text-center">
        <h2>You've successfully unsubscribed.</h2>
        <p>We're sorry to see you go. You can resubscribe at any time.</p>
        <a href="{{ url('/#subscribe') }}" style="background-color: #e12228" class="btn text-white">Subscribe Again</a>
    </div>
@endsection
