<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Appointment extends Model
{

    protected $fillable = [
        'date',
        'user_id',
        'client_id',
        'job_id'
    ];
   
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
