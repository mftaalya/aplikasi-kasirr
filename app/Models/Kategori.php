<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['kategori'];
    protected $table = 'kategori';
    public $timestamps = false;
    
    public function kategori(){
        return $this->hasMany(Product::class);
    }
}
