<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    // protected $fillable = array('user_id', 'name', 'description', 'price', 'image_url', 'video_url', 'created_at', 'updated_at');
    protected $fillable = ['name', 'description', 'price'];

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'product_images');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id');
    }

    public function orderProducts($order_by)
    {
        $query = DB::table('products');

        if ($order_by == 'best_seller') {
            $query->leftJoin('order_items', 'order_items.product_id', '=', 'products.id')
                ->select(DB::raw('sum(order_items.quantity) as quantity, products.*'))
                ->groupBy('products.id', 'products.user_id', 'products.name', 'products.description', 'products.price', 'products.view_count', 'products.image_url', 'products.video_url', 'products.created_at', 'products.updated_at')
                ->orderBy('quantity', 'desc');
        } else if ($order_by == 'terbaik') {
            $query->leftJoin('product_reviews', 'product_reviews.product_id', '=', 'products.id')
                ->select(DB::raw('avg(product_reviews.rating) as rating, products.*'))
                ->groupBy('products.id', 'products.user_id', 'products.name', 'products.description', 'products.price', 'products.view_count' ,'products.image_url', 'products.video_url', 'products.created_at', 'products.updated_at')
                ->orderBy('rating', 'desc');
        } else if ($order_by == 'terbaru') {
            $query->orderBy('created_at', 'desc');
        } else if ($order_by == 'termurah') {
            $query->orderBy('price', 'asc');
        } else if ($order_by == 'termahal') {
            $query->orderBy('price', 'desc');
        }else if ($order_by == 'dilihat') {
            $query->orderBy('view_count', 'desc');
        }
        return $query->paginate(1);
    }
}
