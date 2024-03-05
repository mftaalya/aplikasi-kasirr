<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','kategori_id','price','created_at','updated_at'];

    public function transaction(){
        return $this->belongsToMany(Transaction::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
