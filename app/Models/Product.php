<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product';

    protected $fillable = [
        'store_id',
        'categories_id',
        'name',
        'weight',
        'stock',
        'price',
        'image',
        'description'
    ];

    public function category(){
        return $this->belongsTo(CategoryProduct::class,'categories_id','id');
    }

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }

    // public function toArray(){
    //     $toArray = parent::toArray();
    //     $toArray['image'] = $this->image;
    //     return $toArray;
    // }

    // public function getImageAttribute(){
    //     return Storage::url($this->attributes['image']);
    // }
}
