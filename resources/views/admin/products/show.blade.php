@extends('layouts.admin')

@section('content')
<div class="container col-md-8">
    <div class="row mb-5 justify-content-center">
        <div class="col">
            <h2 class="text-center">Detail Product</h2>
            @csrf
            <div class="form-group">
                <label for="nama">Name Product</label>
                <input class="form-control" type="text" name="nameProduct" id="nama" value="{{ $products['name'] }}" readonly>
            </div>
            <div class="form-group mt-2 mb-2">
                <label for="desc">Description Product</label>
                <div class="tab-content">{!! $products->description !!}</div>
            </div>
            <div class="form-group">
                <label for="price">Price Product</label>
                <input class="form-control" type="text" name="priceProduct" id="price" value="{{ $products['price'] }}">
            </div>

            @if(!$products->images()->get()->isEmpty())
            @foreach($products->images()->get() as $idx => $image)
            @if ($idx == 0 || $idx % 4 == 0 )
            <div class="mt-4">
                @endif
                <img src="{{ asset('/images/'.$image->image_src) }}" class="img img-thumbnail" width="300">
                @if($idx > 0 && $idx % 4 == 3)
            </div>
            @endif
            @endforeach
            @endif
            <div class="form-group">
                <label for="price">Product Created</label>
                <input class="form-control" type="text" name="priceProduct" id="price" value="{{ $products['created_at'] }}">
            </div>
            <div>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection