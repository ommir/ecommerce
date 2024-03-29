@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>List Order</h2>
            <div class="float-left mb-2">
                <a href="{{route ('admin.products.create')}}" class="btn btn-primary">Order</a>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Harga Total</th>
                            <th>Status</th>
                            <th>Kode Pos</th>
                            <th>Alamat Pengiriman</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{$order['id']}}</td>
                            <td>Rp.{{$order['total_price']}}</td>
                            <td>{{$order['status']}}</td>
                            <td>{{$order['zip_code']}}</td>
                            <td>{{$order['shipping_address']}}</td>
                            <td>

                                <a href="{{ route('admin.orders.show', ['id' => $order['id']]) }}">
                                    <button class="btn btn-danger">Lihat</button>
                                </a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection