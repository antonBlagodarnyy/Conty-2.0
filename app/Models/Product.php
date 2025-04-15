<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stockInGrams',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo((User::class));
    }
    public function appointments(): BelongsToMany
    {
        return $this->belongsToMany(Appointment::class);
    }
}
