@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 2%">
                <div class="card" style="width: 40rem;">
                    <div class="card-body">
                        <h4 class="card-title">Verify Your Email Address</h4>
                        @if (session('resent'))
                            <p class="alert alert-success" role="alert">A fresh verification link has been sent to
                                your email address</p>
                        @endif
                        <p class="card-text">Before proceeding, please check your email for a verification link.If you
                            did not receive the email,</p>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link card-link">
                                click here to request another
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection