<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = ['comment', 'rating'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'product_images');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }
}
