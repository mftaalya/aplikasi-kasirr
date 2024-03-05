<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['total_price','pay','change','created_at','updated_at'];
    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
