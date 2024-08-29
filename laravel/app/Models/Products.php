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
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('desc', 'like', '%' . request('search') . '%');
        }
    }

    public function images() {
        return $this->hasMany(Images::class);
    }
    
    public function order_items() {
        return $this->hasMany(Order_items::class);
    }
}
