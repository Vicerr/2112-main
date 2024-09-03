<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $table = 'products';
    use HasFactory;
    protected $primaryKey = 'product_id';

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('tag', 'like', '%' . request('search') . '%');
        }
    }

    public function images() {
        return $this->hasMany(Images::class, 'product_id');
    }
    
    public function order_items() {
        return $this->hasMany(Order_items::class, 'product_id');
    }
}
