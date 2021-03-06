<x-guest-layout>
    <div class="container sign-up-mode">
        <div class="forms-container">
        <div class="signin-signup">
            <form  action="{{ route('login') }}" method="POST" class="sign-in-form">
            @csrf

            <a href="{{route('landing')}}">
            <img src="{{asset('assets/img/logo.png')}}" alt="" srcset="" class="application-logo">
            </a>
            <h2 class="title">Sign in</h2>
            <x-jet-validation-errors class="mb-4" />
            <div class="input-field">
                <i class="fas fa-user"></i>
                <x-jet-input type="email" name="email" placeholder="Email address"  :value="old('email')" required autofocus />
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <x-jet-input type="password" name="password" placeholder="Password" required autocomplete="current-password" />
            </div>
            <x-jet-button class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i>
                    {{ __(' Sign in') }}
                </x-jet-button>
                @if (Route::has('password.request'))
                    <a id="forgot_pswd" class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
                <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
                </a>
                <a href="{{ url('auth/twitter') }}" class="social-icon">
                <i class="fab fa-twitter"></i>
                </a>
                <a href="{{ url('auth/github') }}" class="social-icon">
                <i class="fab fa-github"></i>
                </a>
                <a href="{{ url('auth/linkedin') }}" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            </form>
            <form action="{{ route('register') }}" method="POST" class="sign-up-form">
                @csrf
                <a href="{{route('landing')}}">
                    <img src="{{asset('assets/img/logo.png')}}" alt="" srcset="" class="application-logo">
                </a>
                <h2 class="title">Sign up</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <x-jet-input type="text" placeholder="name"  name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <x-jet-input type="email" placeholder="Email address" name="email" :value="old('email')" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <x-jet-input type="password" placeholder="Password" name="password" required autocomplete="new-password" />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <x-jet-input type="password" placeholder="Repeat Password" name="password_confirmation" required autocomplete="new-password" />
                </div>
                <x-jet-button class="btn"><i class="fas fa-user-plus"></i> 
                    {{ __('Sign Up') }}
                </x-jet-button>
                <p class="social-text">Or Sign up with social platforms</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{ url('auth/twitter') }}" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="{{ url('auth/github') }}" class="social-icon">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="{{ url('auth/linkedin') }}" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            </form>
        </div>
        </div>

        <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
            <h3>New here ?</h3>
            <p>
                Register now and manage project work in order to 
                achieve maximum progress
            </p>
            <button class="btn transparent" id="sign-up-btn">
                Sign up
            </button>
            </div>
            <img src="{{asset('assets/img/svg/login.svg')}}" class="image" alt=""/>
        </div>
        <div class="panel right-panel">
            <div class="content">
            <h3>Already have an account ?</h3>
            <p>
                sign up now and manage your project now
            </p>
            <button class="btn transparent" id="sign-in-btn">
                Sign in
            </button>
            </div>
            <img src="{{asset('assets/img/svg/register.svg')}}" class="image" alt="" />
        </div>
        </div>
    </div>
</x-guest-layout>
