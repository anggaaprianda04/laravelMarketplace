<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'store';

    protected $fillable = [
        'users_id',
        'name_store',
        'village',
        'address',
        'description',
        'account_name',
        'account_number',
        'verification_store',
        'image',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function products(){
        return $this->hasMany(Product::class,'store_id','id');
    }
}
