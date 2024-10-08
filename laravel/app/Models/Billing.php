<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{   
    public $table = 'billing';
    use HasFactory;
    public function users() {
        return $this->belongsTo(user::class);
    }
}
