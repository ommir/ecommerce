@extends('layouts.main-menu')

@section('content')
<div class="container-fluid">
    <div class="row mb-5">
        <div class="col-sm-9">
            <div class="card">
                <h5 class="card-header bg-primary text-white">About Order</h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Alamat Pengiriman</th>
                                <th scope="col">Kode Pos</th>
                                <th scope="col">Harga Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$order->shipping_address}}</td>
                                <td>{{$order->zip_code}}</td>
                                <td>{{$order->total_price}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('home') }}">
                        <button class="btn btn-danger">Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-9">
            <div class="card ">
                <h5 class="card-header bg-primary text-white">About Product</h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $orderItem)
                            <tr>
                                <td>
                                    <a href="{{ route('products.detail', ['id' => $orderItem->product->id])}}">
                                        {{$orderItem->product->name}} </a>
                                </td>
                                <td><img src="{{ asset('/images/'.$product->images()->get()[0]->image_src) }}" width="200"></td>
                                <td>{{$orderItem->price}}</td>
                                <td>{{$orderItem->quantity}}</td>
                                <td>{{$orderItem->price * $orderItem->quantity}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('home') }}">
                        <button class="btn btn-danger">Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection