@if ($errors->any())


    <div {{ $attributes }}>
        <div class="font-medium text-red-600">{{ __('Ầm ầm! Đã xảy ra sự cố.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
