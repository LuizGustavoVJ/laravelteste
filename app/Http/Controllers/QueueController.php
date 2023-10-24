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
        // Executar o comando para processar a fila
        Artisan::call('queue:work', ['--stop-when-empty' => true]);

        // Atualizar a visão com os arquivos restantes na fila
        $queueFiles = $this->removeProcessedFiles();

        if ($queueFiles->isEmpty()) {
            return redirect('/process-queue')->with('status', 'Fila processada com sucesso!')->with('emptyQueue', true);
        }

        return redirect('/process-queue')->with('status', 'Fila processada com sucesso!')->with('emptyQueue', false)->with('queueFiles', $queueFiles);
    }

    protected function removeProcessedFiles()
    {
        // Executar o comando para obter os arquivos processados
        Artisan::call('queue:work', ['--stop-when-empty' => true]);
        
        // Obter arquivos processados
        $processedFiles = Artisan::output();

        // Remover da tabela
        $queueFiles = collect(Storage::files('data'))
            ->filter(function ($file) use ($processedFiles) {
                return !Str::contains($processedFiles, basename($file));
            });

        return $queueFiles;
    }
}
