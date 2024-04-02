<div class="row">
    <div class="col">
        <p>{{ $option->title }}</p>
        @foreach ($option->choices as $choice)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio"  onchange="triggerRelated('{{ $option->title }}', '{{ $choice->title }}');" name="{{ \Illuminate\Support\Str::slug($option->title) }}" id="{{ \Illuminate\Support\Str::slug($option->title . '_' . $choice->title) }}" value="{{ $choice->title }}">
            <label class="form-check-label" for="{{ \Illuminate\Support\Str::slug($option->title . '_' . $choice->title) }}">
                {{ $choice->title }}
            </label>
        </div>
        @endforeach
    </div>
</div>
