<div id="productImageMain" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators d-none d-sm-flex">
    @if ($product->main_image)
    <button type="button" data-bs-target="#productImageMain" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    @endif
      @foreach ($product->images as $image)
    <button type="button" data-bs-target="#productImageMain" data-bs-slide-to="{{ $image->order+1 }}" aria-label="Slide {{ $image->order+1 }}"></button>
        @endforeach
  </div>
  <div class="carousel-inner">
    @if ($product->main_image)
    <div class="carousel-item active">
      <img src="{{url($product->main_image)}}" class="d-block w-100" alt="...">
    </div>
    @endif
        @foreach ($product->images as $image)
    <div class="carousel-item">
      <img src="{{url($image->image)}}" class="d-block w-100" alt="...">
    </div>
        @endforeach
  </div>
  <button class="carousel-control-prev d-none d-sm-flex" type="button" data-bs-target="#productImageMain" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next d-none d-sm-flex" type="button" data-bs-target="#productImageMain" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="row">
  @if ($product->main_image)
  <div class="col">
    <a href="#" data-bs-target="#productImageMain" data-bs-slide-to="0">
      <img src="{{url('/images/placeholder.jpg')}}" class="img-fluid">
    </a>
  </div>
  @endif
    @foreach ($product->images as $image)
  <div class="col">
    <a href="#" data-bs-target="#productImageMain" data-bs-slide-to="{{ $image->order }}">
      <img src="{{url($image->image)}}" class="img-fluid">
    </a>
  </div>
    @endforeach
</div>
