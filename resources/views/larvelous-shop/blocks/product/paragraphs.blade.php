@foreach ($product->paragraphs as $paragraph)
    <div class="row">
        @if ($paragraph->image && $paragraph->image_position === 'left')
        <div class="col-12 mb-3 col-sm-6"><img src="{{url($paragraph->image)}}" class="img-fluid"></div>
       @endif

        <div class="col-12 col-sm-6">
            @if ($paragraph->title)
            <h5>{{ $paragraph->title }}</h5>
            @endif

            @if ($paragraph->text)
            <p>{{ $paragraph->text }}</p>
            @endif

            @if ($paragraph->url)
            <p>
                <a href="{{ $paragraph->url }}" class="btn btn-outline-primary">
                    @if ($paragraph->url_text) {{$paragraph->url_text}} @else {{ __('insyht-larvelous-shop::translations.readMore') }} @endif
                </a>
            </p>
            @endif
        </div>

        @if ($paragraph->image && $paragraph->image_position === 'right')
        <div class="col-12 mb-3 col-sm-6"><img src="{{url($paragraph->image)}}" class="img-fluid"></div>
        @endif
    </div>
@endforeach
