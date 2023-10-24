<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QueueController extends Controller
{
    public function showProcessQueueForm()
    {
        $queueFiles = Storage::files('data');
        return view('process-queue', ['queueFiles' => $queueFiles]);
    }

    public function processQueue()
    {
        Artisan::call('queue:work', ['--stop-when-empty' => true]);

        // Remover arquivos processados da tabela
        $this->removeProcessedFiles();

        return redirect('/process-queue')->with('status', 'Fila processada com sucesso!');
    }

    protected function removeProcessedFiles()
    {
        // Obter arquivos processados
        $processedFiles = Artisan::output();

        // Remover da tabela
        $queueFiles = collect(Storage::files('data'))
            ->filter(function ($file) use ($processedFiles) {
                return !Str::contains($processedFiles, basename($file));
            });

        // Atualizar a visão
        return view('process-queue', ['queueFiles' => $queueFiles]);
    }
}
