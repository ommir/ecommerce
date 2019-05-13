@extends('layouts.main-menu')

@section('content')

<div class="container" id="detailkonten">
    <div class="row mt-4">
        @if(!$products->images()->get()->isEmpty())
        <div class="col-md-5">
            <div class="product-section-image">
                <img src="{{ asset('/images/'.$products->images()->get()[0]->image_src) }}" class="card-img-top" id="currentImage">
            </div>

            <div class="product-section-images">
                @foreach($products->images()->get() as $image)
                <div class="product-thumbnail mt-3">
                    <img src="{{ asset('/images/'.$image->image_src) }}" class="card-img-top">
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="col-md-7">
            <h3>
                {{ $products['name'] }}
            </h3>
            <h4>
                {{ $products['price'] }}
            </h4>

            <h5>
                @for($x = 0; $x < $rating; $x++) @if(floor($rating) - $x>= 1)
                    <i class="text-warning fa fa-star"></i>
                    @elseif($rating - $x > 0)
                    <i class="text-warning fa fa-star-half-o"></i>
                    @else
                    <i class="text-warning fa fa-star-o"></i>
                    @endif
                    @endfor
                    <br>
                    Rating Product : {{ floatval($rating) }}
            </h5>
            <div class="mt-4">
                <a href="{{ route('carts.add', $products->id) }}" class="btn btn-primary">Buy</a>
            </div>
            <div class="mt-2">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('products.show', ['id' => $products['id']]) }}" class="social-button" target="_blank"><span class="fa fa-facebook-official"></span>&nbsp;Share Facebook</a>
                |
                <a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ route('products.show', ['id' => $products['id']]) }}" class="social-button" target="_blank"><span class="fa fa-twitter"></span>&nbsp;Share Twitter</a>
                |
                <a href="https://wa.me/?text={{ route('products.show', ['id' => $products['id']]) }}" class="social-button" target="_blank"><span class="fa fa-whatsapp"></span>&nbsp;Share Whatsapp</a>
            </div>
            <div class="mt-4">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-description-tab" data-toggle="tab" href="#nav-description" role="tab" aria-controls="nav-description" aria-selected="true">Description</a>
                    <a class="nav-item nav-link" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="false">Review</a>
                </div>
                <!-- Tab Panes -->
                <div class="tab-content mt-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                        {!! $products['description'] !!}
                    </div>
                    <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                        @if(Auth::check())
                        <form action="{{ route('posts.review') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="text" name="product_id" value="{{ $products['id'] }}" hidden>
                            <div class="form-group">
                                <label for="desc">Comments</label>
                                <input class="form-control" type="text" name="comment" id="ckview">
                            </div>
                            <script src="{{url('js/jquery.tinymce.min.js')}}"></script>
                            <script src="{{url('js/tinymce.min.js')}}"></script>
                            <script>
                                tinymce.init({
                                    selector: '#ckview'
                                });
                            </script>
                            <div class="form-group">
                                <label for="nama">Rating</label>
                                <input class="form-control" type="text" name="rating" placeholder="Rating 1-5" id="nama">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        @else
                        <div class="d-block p-2 bg-primary text-white">
                            <h1>Login first for add a comment</h1>
                        </div>
                        @endif
                        @foreach($users as $d)

                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
                                        <p class="text-secondary text-center">{{ Carbon\Carbon::parse($d->created_at)->diffForHumans()}}</p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <strong>{{ $d->name }}</strong>
                                            @for($x = 0; $x < number_format($d->rating,2); $x++) @if(number_format($d->rating,2) - $x >= 1)
                                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                                @elseif(number_format($d->rating,2) - $x > 0)
                                                <span class="float-right"><i class="text-warning fa fa-star-half-o"></i></span>
                                                @else
                                                <span class="float-right"><i class="text-warning fa-star-half-o"></i></span>
                                                @endif
                                                @endfor
                                        </p>
                                        <div class="clearfix"></div>
                                        <p>{!! $d->comment !!}</p>
                                        <p>
                                            <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
                                            <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('extra-js')
<script>
    (function() {
        const currentImage = document.querySelector('#currentImage');
        const images = document.querySelectorAll('.product-thumbnail');

        images.forEach((element) => element.addEventListener('click', thumbnailClick));

        function thumbnailClick(e) {
            currentImage.src = this.querySelector('img').src;
        }
    })();
</script>
@endsection