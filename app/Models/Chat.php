<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'response'];

    // Optional: Relationship with User model (if using user authentication)
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
