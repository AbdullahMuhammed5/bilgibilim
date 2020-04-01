@extends('layouts.front')

@section('content')

    <div class="container-contact100 mb-5">
        <div class="wrap-contact100">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <form method="POST" class="contact100-form validate-form" action="{{ route('front.sendContact') }}">
                {{ csrf_field() }}
                <h2 class="title mb-5 text-uppercase font-weight-bold">
                    Send Us A Message
                </h2>

                <div class="wrap-input100 validate-input" data-validate="Please enter your name">
                    <input class="input100" type="text" name="name" placeholder="Full Name" value="{{ old('name') }}">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Please enter your email: e@a.x">
                    <input class="input100" type="text" name="email" placeholder="E-mail" value="{{ old('email') }}">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Please enter your phone">
                    <input class="input100" type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Please enter your message">
                    <textarea class="input100" name="message" placeholder="Your Message" value="{{ old('message') }}"></textarea>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn" type="submit">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Send
						</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@stop
