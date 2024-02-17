<x-guest-layout>

    <x-authentication-card>


        <x-validation-errors class="mb-4" />






            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="heading-section text-success text-center"
                                    style="font-weight: bold;font-size: 40px">Đăng nhập
                                </h1>
                            </div>
                            <div class="card-body">
                                <div class="login-wrap p-0">

                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('login') }}" class="signin-form">
                                        @csrf

                                        <div class="form-group">
                                            <x-label for="email" value="{{ __('Email') }}" />
                                            <x-input id="email" style="color: black" class="block mt-1 w-full"
                                                type="email" name="email" :value="old('email')" required autofocus
                                                autocomplete="username" />
                                        </div>
                                        <div class="form-group">
                                            <x-label for="password" value="{{ __('Password') }}" />
                                            <x-input id="password" style="color: black" class="block mt-1 w-full"
                                                type="password" name="password" required
                                                autocomplete="current-password" />
                                            {{-- <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span> --}}
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="form-control btn btn-primary submit px-3">
                                                {{ __('Log in') }}
                                            </button>
                                        </div>
                                        <div class="form-group d-md-flex">
                                            <div class="w-50">
                                                <label for="remember_me" class="checkbox-wrap checkbox-primary">
                                                    <x-checkbox id="remember_me" name="remember" />
                                                    <span class="ml-2 text-sm ">{{ __('Remember me') }}</span>
                                                </label>
                                            </div>

                                            <div class="w-50 text-md-right">
                                                @if (Route::has('password.request'))
                                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                        href="{{ route('password.request') }}">
                                                        {{ __('Quên mật khẩu?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



    </x-authentication-card>


</x-guest-layout>
