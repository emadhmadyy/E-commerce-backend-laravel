<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
    
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['product_id','description', 'stock_quantity'];
    protected $primaryKey = null; // No primary key in this table
    public $incrementing = false; // Disable auto-incrementing primary key assumption    
}
