<div class="row">
    <div class="col">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="{{ $option->title }}" aria-label="{{ $option->title }}" @if ($option->hasSetting('maxlength')) maxlength="{{ $option->getSettingValue('maxlength') }}" @endif aria-describedby="{{ \Illuminate\Support\Str::slug
            ($option->title) }}">
            @if ($option->hasSetting('maxlength'))
                <span class="input-group-text" id="{{ \Illuminate\Support\Str::slug($option->title) }}">0/{{ $option->getSettingValue('maxlength') }}</span>
            @endif
        </div>
    </div>
</div>
