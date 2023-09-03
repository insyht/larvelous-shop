@extends('insyht-larvelous::layouts.website')
@section('content')
    <div class="row">
        <div class="col">
            @if ($productCategory->image)
            <img src="{{url($productCategory->image)}}" class="img-fluid w-100">
            @endif
        </div>
    </div>
    <h1 class="text-center">{{ $productCategory->title }}</h1>
    @if ($productCategory->introduction)
    <div class="row">
        <div class="col">
            <p class="lead">{{ $productCategory->introduction }}</p>
        </div>
    </div>
    @endif


    <div class="row justify-content-between">
        <div class="col">
            <p class="h3 w-100">
                {{ $products->count() }} {{ __('insyht-larvelous-shop::translations.productOrProducts') }} {{--
                todo paginering --}}
                <small class="text-muted">{{ $products->count() }} {{ __('insyht-larvelous-shop::translations.productOrProductsTotal') }}</small>
            </p>
        </div>
        <div class="col-12 col-md-3">
            <div class="dropdown">
{{--                <button class="btn btn-lg btn-primary dropdown-toggle w-100" type="button" id="sortProducts"--}}
{{--                        data-bs-toggle="dropdown">--}}
{{--                    <i class="bi bi-sort-down"></i> Prijs (laag-hoog)--}}
{{--                </button>--}}
{{--                <ul class="dropdown-menu">--}}
{{--                    <li>--}}
{{--                        <button class="dropdown-item active" type="button">Prijs (laag-hoog)</button>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <button class="dropdown-item" type="button">Prijs (hoog-laag)</button>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <button class="dropdown-item" type="button">Beoordeling (hoog-laag)</button>--}}
{{--                    </li>--}}
{{--                </ul>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 col-md-3 accordion mb-5" id="productFilters">
            @if ($productCategory->getAvailableFilters()->count() > 0)
                @foreach ($productCategory->getAvailableFilters() as $filterName => $filter)
                    @include('insyht-larvelous-shop::attribute_types.' . $filter['template'])
                @endforeach
            @endif
        </div>

    <div class="col">
        @if (count($productCategory->children) > 0)
        <div class="row mb-5">
            @foreach ($productCategory->children as $subcategory)
            @include('insyht-larvelous-shop::subcategory-block', ['category' => $subcategory])
            @endforeach
        </div>
        @endif

        @if ($products->count() > 0)
        <div class="row">
            @foreach ($products as $product)
            @include('insyht-larvelous-shop::product-block', ['product' => $product])
            @endforeach
        </div>

{{--        <div class="row">--}}
{{--            <div class="col">--}}
{{--                <nav aria-label="...">--}}
{{--                    <ul class="pagination justify-content-center">--}}
{{--                        <li class="page-item disabled">--}}
{{--                            <a class="page-link">Vorige</a>--}}
{{--                        </li>--}}
{{--                        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                        <li class="page-item active" aria-current="page">--}}
{{--                            <a class="page-link" href="#">2</a>--}}
{{--                        </li>--}}
{{--                        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                        <li class="page-item">--}}
{{--                            <a class="page-link" href="#">Volgende</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
{{--            </div>--}}
{{--        </div>--}}
        @else
            {{ __('insyht-larvelous-shop::translations.noProductsInCategory') }}
        @endif
    </div>
</div>
@endsection
