<div class="accordion-item">
    <div class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#productFilters{{ \Illuminate\Support\Str::slug($filterName) }}">
            {{ $filterName }}
        </button>
    </div>
    <div id="productFilters{{ \Illuminate\Support\Str::slug($filterName) }}" class="accordion-collapse collapse @if ($filter['active'] === true) show @endif">
        <div class="accordion-body">
            @foreach ($filter['values'] as $filterValue)
                <button type="button" class="list-group-item list-group-item-action @if ($filterValue->isActive()) active @endif" @if ($filterValue->isActive()) onclick="removeFilter('text', this, {{ $filter['attributeId'] }});" @else onclick="applyFilter('text', this, {{ $filter['attributeId'] }});" @endif>
                    {{ $filterValue->value }}
                </button>
            @endforeach
            <br />
            {{--Todo only show delete button when this filter is set--}}
            <button class="btn btn-danger col-12" onclick="removeFilter({{ $filter['attributeId'] }});">
                {{ __('insyht-larvelous-shop::translations.removeFilter') }}
            </button>
        </div>
    </div>
</div>
