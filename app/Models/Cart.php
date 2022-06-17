<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'cart';

    protected $fillable = [
        'users_id',
        'product_id',
        'quantity',
    ];

    public function user(){
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
