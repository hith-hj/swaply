@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => ' text-sm ']) }}>
        {{ $status }}
    </div>
@endif
