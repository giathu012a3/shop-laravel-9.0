<x-guest-layout>
    <x-authentication-card>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">

                    <div class="card-body">
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Trước khi tiếp tục, bạn có thể xác minh địa chỉ email của mình bằng cách nhấp vào liên kết chúng tôi vừa gửi email cho bạn không? Nếu bạn không nhận được email, chúng tôi sẽ sẵn lòng gửi cho bạn một email khác.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('Liên kết xác minh mới đã được gửi đến địa chỉ email bạn đã cung cấp trong cài đặt hồ sơ của mình.') }}
                            </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <x-button type="submit">
                                        {{ __('Resend Verification Email') }}
                                    </x-button>
                                </div>
                            </form>

                            <div>
                                <a href="{{ route('profile.show') }}"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Edit Profile') }}</a>

                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf

                                    <button type="submit"
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
