<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    public $table = 'order_items';
    use HasFactory;
    public function products() {
        return $this->belongsTo(products::class);
    }
}
