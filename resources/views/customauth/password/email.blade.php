@extends('layouts.forgot-password')
@section('content')

                    <div class="form">
                    <h1>Retrieve Password</h1>
                    <form class="cmxform form-horizontal tasi-form" id="loginForm" method="POST" action="{{url('/forgot-password')}}" novalidate="novalidate">
                        @csrf
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             @if (session('status'))
                                {{ session('status') }}
                             @else
                             Enter your <b>Email</b> and instructions will be sent to you!
                             @endif
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" required="" aria-required="true" autofocus placeholder="{{__('Email Address')}}">
                                 @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <label>{{ $message }}</label>
                                </span>  
                                @enderror                               
                            </div>
                        </div>
                        <div class="form-group retrieve_btn">
                            <div class="col-12">
                                <button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit"> {{__('Send Password Reset Link')  }}</button> 
                            </div>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection