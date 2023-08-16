<div class="col">
    <a href="{{ $subcategory->fullUrl }}">
        <div class="card">
            <img src="{{url($subcategory->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $subcategory->title }} ({{ count($subcategory->hierarchicalProducts()) }})
                </h5>
            </div>
        </div>
    </a>
</div>
