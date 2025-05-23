<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function appointments(): BelongsToMany
    {
        return $this->belongsToMany(Appointment::class);
    }
}
