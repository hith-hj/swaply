@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <ul class="mt-2 p-0 m-auto" style="list-style:none">
            <li>{{ __('عفوا ,حدث خطاء ما ') }}</li>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
