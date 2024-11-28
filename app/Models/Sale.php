<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['customer_id', 'product_name', 'amount'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
