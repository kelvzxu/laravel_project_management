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
</div>
    <!-- <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>

                <a class="ml-1 btn btn-primary" href="{{ url('auth/github') }}" style="margin-top: 0px !important;background: blue;color: #ffffff;padding: 5px;border-radius:7px;" id="btn-fblogin">
                    <i class="fa fa-github" aria-hidden="true"></i> Login with Github
                </a>
            </div>
        </form>
    </x-jet-authentication-card>-->
</x-guest-layout>
