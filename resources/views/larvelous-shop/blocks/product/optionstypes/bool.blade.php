<div class="row">
    <div class="col">
        <div class="form-check form-switch ml-3">
            <input class="form-check-input" type="checkbox" role="switch" id="{{ \Illuminate\Support\Str::slug($option->title) }}">
            <label class="form-check-label" for="{{ \Illuminate\Support\Str::slug($option->title) }}">{{ $option->title }}</label>
        </div>
    </div>
</div>
