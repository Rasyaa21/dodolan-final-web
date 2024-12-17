@extends('layouts.app')

@section('content')
<style>
    @keyframes pop-up {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .success-icon {
        animation: pop-up 1s ease-out;
    }

    .centered-content {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 88vh;
        text-align: center;
    }
</style>

<div class="centered-content">
    <div>
        <div class="mb-4 success-icon d-inline-flex justify-content-center align-items-center" style="width: 100px; height: 100px; border-radius: 50%; background-color: #28a745;">
            <svg class="text-white w-50 h-50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h1 class="mb-3 display-4 text-success"><strong>Payment Successful!</strong></h1>
        <p class="mb-4 lead text-muted">Thank you for your purchase. Your order has been confirmed.</p>
        <a href="{{ route('landing') }}" class="btn btn-success btn-lg">Go Back</a>
    </div>
</div>

@endsection
