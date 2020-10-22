<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <div id="logreg-forms">
            <x-jet-validation-errors class="mb-4 alert alert-danger" role="alert"/>
            @if (session('status'))
            @endif
            <form method="POST" class="form-signin ml-2 ml-md-0" action="{{ route('login') }}">
                @csrf
                <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>
                <div class="social-login">
                    <a class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </a>
                    <a href="{{ url('auth/github') }}" class="btn ml-md-1 github-btn social-btn" type="button"><span><i class="fab fa-github"></i> Sign in with Github</span> </a>
                </div>
                <p style="text-align:center"> OR  </p>
                <x-jet-input class="form-control" type="email" name="email" placeholder="Email address"  :value="old('email')" required autofocus />
                <x-jet-input class="form-control" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
                <x-jet-button class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i>
                    {{ __('Sign in') }}
                </x-jet-button>
                @if (Route::has('password.request'))
                    <a id="forgot_pswd" class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <hr>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary btn-block text-white" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</a>
                @endif
            </form>      
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
