<div class="col" id="{{ \Illuminate\Support\Str::slug($option->title) }}">
    @if ($option->relatedOption)
        @foreach ($option->relatedOption->choices as $choice)
                <div  style="display: none" data-parent-option="{{ $option->relatedOption->title }}" data-parent-choice="{{ $choice->title }}">
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="{{ \Illuminate\Support\Str::slug($option->title . '_' . $choice->title) }}">
                          {{ $option->title }} {{ $choice->title }}
                      </label>
                      <select class="form-select" id="{{ \Illuminate\Support\Str::slug($option->title . '_' . $choice->title) }}">
                          @foreach ($option->choices as $optionChoice)
                          <option value="{{ $optionChoice->title }}">{{ $optionChoice->title }}</option>
                          @endforeach
                      </select>
                    </div>
                </div>
        @endforeach
    @endif
</div>
