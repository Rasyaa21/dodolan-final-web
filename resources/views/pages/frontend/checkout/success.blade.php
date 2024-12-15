@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout Successful</h1>
    <p>Thank you for your purchase! (Dummy Data)</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
</div>
@endsection