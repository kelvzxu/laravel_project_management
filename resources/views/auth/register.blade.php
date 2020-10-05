<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
    
        <x-jet-validation-errors class="mb-4" />
        <div id="logreg-forms">
            <form method="POST" action="{{ route('register') }}" class="form-signup ml-2 ml-md-0">
                @csrf
                <div class="social-login">
                    <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span> </button>
                </div>
                <div class="social-login">
                    <button class="btn github-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>
                </div>
                
                <p style="text-align:center">OR</p>
                <x-jet-input class="block mt-1 w-full" type="text" placeholder="Full name"  name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-jet-input class="block mt-1 w-full" type="email" placeholder="Email address" name="email" :value="old('email')" required />
                <x-jet-input class="block mt-1 w-full" type="password" placeholder="Password" name="password" required autocomplete="new-password" />
                <x-jet-input class="block mt-1 w-full" type="password" placeholder="Repeat Password" name="password_confirmation" required autocomplete="new-password" />

                <x-jet-button class="btn btn-primary btn-block"><i class="fas fa-user-plus"></i> 
                    {{ __('Sign Up') }}
                </x-jet-button>
                <br>
                <a id="cancel_signup" class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}"><i class="fas fa-angle-left"></i>
                    {{ __('Already registered?') }}
                </a>
            </form>
            <br>
                
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
