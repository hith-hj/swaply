@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600" style="list-style:none">
            <li>{{ __('Whoops! Something went wrong.') }}</li>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
