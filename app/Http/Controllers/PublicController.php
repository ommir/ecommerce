<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Foundation\Auth\User;
use DB;
use Auth;

class PublicController extends Controller
{

    public function __construct()
    { }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('public.product', compact('product'));
    }

    public function indexUtama(Request $request)
    {
        // $product = Product::all();
        // return view('public.public-user', compact('product'));
        $productInstance = new Product();
        $products = $productInstance->orderProducts($request->get('order_by'));
        if ($request->ajax()) {
            return response()->json($products, 200);
        }
        return view('public.public-user', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productReview = new ProductReview();
        $productReview->user_id = Auth::user()->id;
        $productReview->product_id = $request->post('product_id');
        $productReview->comment = $request->post('comment');
        $productReview->rating = $request->post('rating');
        if ($productReview->rating > 5) {
            return redirect('/')->with('error', 'Rating must be 1 - 5');
        }
        $productReview->save();

        return redirect('/')->with('success', 'Product allready saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($id);
        // $users = Auth::user()->id;
        // $article = Article::with('user.comments')->find($id);
        $rating = $products->reviews()->avg('rating');
        $product_reviews = new ProductReview();
        $users = DB::table('product_reviews')
            ->join('users', 'product_reviews.user_id', '=', 'users.id')
            ->join('products', 'product_reviews.product_id', '=', 'products.id')
            ->select('product_reviews.comment', 'product_reviews.created_at', 'product_reviews.rating', 'users.name')
            ->where('product_reviews.product_id', '=', $id)
            ->get();
        return view('public.detail', compact('products', 'rating', 'users', 'rating_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
