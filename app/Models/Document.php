<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

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

    public static function importDocuments(array $documentData): void
    {
        try {
            // Buscar ou criar a categoria
            $category = Category::firstOrCreate(['name' => $documentData['categoria']]);
            
            // Criar o documento usando o relacionamento
            $document = new self([
                'title' => $documentData['titulo'],
                'contents' => $documentData['conteúdo'],
            ]);

            // Atribuir o relacionamento
            $document->category()->associate($category);

            // Salvar o documento
            $document->save();
        } catch (\Exception $e) {
            logger("Erro ao criar o documento para a categoria '{$documentData['categoria']}': {$e->getMessage()}\n");
        }
    }
}
