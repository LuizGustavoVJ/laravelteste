<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class ProcessDocumentImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    /**
     * Create a new job instance.
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Ler o arquivo JSON
            $jsonContent = Storage::get($this->filePath);
            $data = json_decode($jsonContent, true);

            // Certificar-se de que a chave 'documentos' existe e não está vazia
            if (isset($data['documentos']) && is_array($data['documentos'])) {
                // Adicionar registros à tabela de documentos
                foreach ($data['documentos'] as $documentData) {
                    Document::importDocuments($documentData);
                }
            } else {
                // Log ou manipulação de erro
                logger('A chave "documentos" não está presente ou está vazia no arquivo JSON: ' . $this->filePath);
            }
        } catch (\Exception $e) {
            logger("Erro durante o processamento do trabalho: {$e->getMessage()}");
        }
        
    }

    /**
     * Get the file path.
     */
    public function getFilePath()
    {
        return $this->filePath;
    }
}
