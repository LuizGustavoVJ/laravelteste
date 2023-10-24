<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'contents'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Para preenchimento automático do created_at
    protected $dispatchesEvents = [
        'creating' => \App\Events\DocumentCreating::class,
    ];
}
