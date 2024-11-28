<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'phone'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
