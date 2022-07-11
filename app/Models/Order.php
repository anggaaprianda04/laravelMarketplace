<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order';

    protected $fillable = [
        'address',
        'phone',
        'image',
        'users_id',
        'store_id',
        'status',
        'total_price',
        'product_id',
        'created_at'
    ];

    public function items()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function market()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
