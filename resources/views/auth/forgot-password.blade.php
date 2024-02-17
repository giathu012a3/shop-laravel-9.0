<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

       

       

        

        {{-- <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form> --}}

        <div>
            <div class="row justify-content-center">


            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="heading-section text-dark" style="font-weight: bold;font-size: 40px"> Tìm lại tài khoản</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-4 text-sm black">
                                {{ __('Quên Mật khẩu? Không vấn đề gì. Chỉ cần cho chúng tôi biết địa chỉ email của bạn và chúng tôi sẽ gửi email cho bạn một liên kết đặt lại mật khẩu cho phép bạn chọn một liên kết mới.') }}
                            </div>
                            <div class="login-wrap p-0">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group">
                                        <x-label for="email" value="{{ __('Email') }}" />
                                        <x-input style="color: black" id="email" class="block mt-1 w-full"
                                            type="email" name="email" :value="old('email')" required autofocus
                                            autocomplete="username" />
                                    </div>
                                    <x-validation-errors class="mb-4" />
                                    @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary submit px-3">
                                            {{ __('Email Password Reset Link') }}
                                        </button>
                                    </div>


                            </div>
                        </div>

                    </div>

                    </form>

                </div>
            </div>
        </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
