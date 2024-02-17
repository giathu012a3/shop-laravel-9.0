<x-guest-layout >
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />


    

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                   
                    <div class="card">
                        <div class="card-header">
                            <h1 class="heading-section text-success text-center" style="font-weight: bold;font-size: 40px">Đăng kí</h1>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" class="signin-form">
                                @csrf
                    
                               
                                <div class="form-group">
                                    <x-label  for="name" value="{{ __('Name') }}" />
                                    <x-input style="color: black" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                    
                                <div class="form-group">
                                    <x-label  for="email" value="{{ __('Email') }}" />
                                    <x-input style="color: black" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                </div>
                    
                                <div class="form-group">
                                    <x-label  for="phone" value="{{ __('phone') }}" />
                                    <x-input style="color: black" id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autocomplete="username" />
                                </div>
                    
                                <div class="form-group">
                                    <x-label  for="address" value="{{ __('address') }}" />
                                    <x-input style="color: black" id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="username" />
                                </div>
                    
                                <div class="form-group">
                                    <x-label  for="password" value="{{ __('Password') }}" />
                                    <x-input style="color: black" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                </div>
                    
                                <div class="form-group">
                                    <x-label  for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <x-input style="color: black" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary submit px-3">
                                        {{ __('Đăng kí') }}
                                    </button>
                                </div>
                                <a  class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                    {{ __('Bạn đã có tài khoản?') }}
                                </a>
                                    <div class="w-50 text-md-right">
                                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div class="mt-4">
                                            <x-label  for="terms">
                                                <div class="flex items-center">
                                                    <x-checkbox name="terms" id="terms" required />
                        
                                                    <div class="ml-2">
                                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                            </x-label>
                                        </div>
                                    @endif
                                    
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                  

                </div>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
