@extends('layouts.main-menu')

@section('content')

<div class="container" id="konten">
    <div class="row mt-2">
        <div class="col-md-4 offset-md-8">
            <div class="form-group">
                <select id="order_field" class="form-control">
                    <option value="" disabled selected>Urutkan</option>
                    <option value="best_seller">Best Seller</option>
                    <option value="terbaik">Terbaik (Berdasarkan Rating)</option>
                    <option value="termurah">Termurah</option>
                    <option value="termahal">Termahal</option>
                    <option value="terbaru">Terbaru</option>
                    <option value="dilihat">Dilihat Paling Banyak</option>
                </select>
            </div>
        </div>
    </div>

    <div id="product-list">
        @foreach($products as $idx => $p)
        @if ($idx == 0 || $idx % 4 == 0 )
        <div class="row mt-5">
            @endif
            <div class="col">
                <div class="card">
                    <?php
                    $product = App\Models\Product::find($p->id);
                    ?>
                    <img src="{{ asset('/images/'. $product->images()->get()[0]->image_src) }}" class="img img-thumbnail" alt="">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('products.show', ['id' => $p->id]) }}">
                                {{ $p->name }}
                            </a>
                        </h5>
                        <p class="card-text">
                            <label for="">Price</label>
                            {{ $p->price }}
                        </p>
                        <a href=" {{ route('carts.add', $p->id) }} " class="btn btn-primary" name="detail">Buy</a>
                        <a href=" {{ route('products.detail', $p->id) }} " class="btn btn-warning">Detail</a>
                    </div>
                </div>
            </div>
            @if($idx > 1 && $idx % 4 == 3)
        </div>
        @endif
        @endforeach
    </div>
</div>
<?php
$product = App\Models\Product::paginate(1);
?>
<div id="pagination">
    {{ $product->links() }}
</div>
</div>
@endsection
@section('extra-js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#order_field').change(function() {
            $.ajax({
                type: 'GET',
                url: '/',
                data: {
                    order_by: $(this).val(),
                },
                dataType: 'json',
                success: function(data) {
                    var products = '';
                    $.each(data, function(idx, product) {
                        if (idx == 0 || idx % 4 == 0) {
                            products += '<div class= "row mt-4">';
                        }
                        products += '<div class="col">' +
                            '<div class="card">' +
                            '<img src="/images' + product.image_src + '" class="img img-thumbnail" width="1200" heigth="600">' +
                            '<div class="card-body">' +
                            '<h5 class="card-title">' +
                            '<a href="/product/detail/' + product.id + '">' +
                            product.name +
                            '</a>' +
                            '</h5>' +
                            '<p class="card-text">' +
                            product.price +
                            '</p>' +
                            '<a href="/carts/add/' + product.id + '" class= "btn btn-primary">Buy</a>' +
                            '<a href="/product/detail/' + product.id + '" class= "btn btn-warning">Detail</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        if (idx > 0 && idx % 4 == 3) {
                            products += '</div>';
                        }
                    });
                    // update element
                    $('#product-list').html(products);
                },
                error: function(data) {
                    alert('Unable to handle request');
                }
            });
        });
    });
</script>
@endsection