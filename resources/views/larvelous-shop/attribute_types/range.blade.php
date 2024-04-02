<div class="accordion-item">
    <div class="accordion-header">
        <button class="accordion-button collapsed @if ($filter['active']) active @endif" type="button" data-bs-toggle="collapse" data-bs-target="#productFilters{{ \Illuminate\Support\Str::slug($filterName) }}">
            {{ $filterName }}
        </button>
    </div>
    <div id="productFilters{{ \Illuminate\Support\Str::slug($filterName) }}" class="accordion-collapse collapse @if ($filter['active'] === true) show @endif">
        <div class="accordion-body">
            <label for="filter-{{ \Illuminate\Support\Str::slug($filterName) }}-min" class="form-label">{{ __('insyht-larvelous-shop::translations.minimum') }}</label>
            <div class="row mt-0 mb-0">
                <div class="col">
                    <input type="range" class="form-range" min="{{ $filter['min'] }}" max="{{ $filter['max'] }}" value="{{ $filter['chosenValues']['min'] }}" id="filter-{{ \Illuminate\Support\Str::slug($filterName) }}-min" oninput="document.getElementById('filter-{{ \Illuminate\Support\Str::slug($filterName) }}-min-value').innerHTML = this.value + '{{ $filter['unit'] }}'">
                </div>
                <div class="col" id="filter-{{ \Illuminate\Support\Str::slug($filterName) }}-min-value">{{ $filter['chosenValues']['min'] }}{{ $filter['unit'] }}</div>
            </div>

            <label for="filter-{{ \Illuminate\Support\Str::slug($filterName) }}-max" class="form-label">{{ __('insyht-larvelous-shop::translations.maximum') }}</label>
            <div class="row mt-0 mb-0">
                <div class="col">
                    <input type="range" class="form-range " min="{{ $filter['min'] }}" max="{{ $filter['max'] }}" value="{{ $filter['chosenValues']['max'] }}" id="filter-{{ \Illuminate\Support\Str::slug($filterName) }}-max" oninput="document.getElementById('filter-{{ \Illuminate\Support\Str::slug($filterName) }}-max-value').innerHTML = this.value + '{{ $filter['unit'] }}'">
                </div>
                <div class="col" id="filter-{{ \Illuminate\Support\Str::slug($filterName) }}-max-value">{{ $filter['chosenValues']['max'] }}{{ $filter['unit'] }}</div>
            </div>
            <button class="btn btn-primary col-5" onclick="applyFilter('range', 'productFilters{{ \Illuminate\Support\Str::slug($filterName) }}', {{ $filter['attributeId'] }});">
                {{ __('insyht-larvelous-shop::translations.applyFilter') }}
            </button>
            @if ($filter['active'])
            <button class="btn btn-danger col-5" onclick="removeFilter({{ $filter['attributeId'] }});">
                {{ __('insyht-larvelous-shop::translations.removeFilter') }}
            </button>
                      @endif
        </div>
    </div>
</div>
