<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    // Les champs que l'utilisateur peut remplir
    protected $fillable = ['name', 'type', 'description', 'user_id'];

    // Un animal appartient à un utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}