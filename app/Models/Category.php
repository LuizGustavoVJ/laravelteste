<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Para preenchimento automático do created_at
    protected $dispatchesEvents = [
        'creating' => \App\Events\CategoryCreating::class,
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
