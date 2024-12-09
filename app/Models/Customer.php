<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = ['name', 'email', 'phone'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Route notifications for Twilio.
     *
     * @return string
     */
    public function routeNotificationForTwilio()
    {
        return $this->phone; // Ensure the `phone` is available on the notifiable
    }
}
