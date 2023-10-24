<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessDocumentImport;
use App\Models\Document;
use App\Models\Category;

class DocumentController extends Controller
{
    public function showImportForm()
    {
        return view('import-form');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:json|max:10240', // Adjust max file size as needed
        ]);
    
        // 1 - Pegar o nome do arquivo selecionado pelo cliente
        $fileName = $request->file('file')->getClientOriginalName();
    
        // 2 - Validar se é um arquivo Json
        $fileExtension = $request->file('file')->extension();
        if ($fileExtension !== 'json') {
            return redirect('/import')->with('error', 'Formato de arquivo inválido. Por favor, envie um arquivo JSON.');
        }
    
        // 3 - Mover o arquivo para a pasta 'data' dentro de 'storage'
        $filePath = $request->file('file')->storeAs('data', $fileName);
    
        // Leitura do conteúdo do arquivo JSON
        $jsonContent = file_get_contents(storage_path("app/data/$fileName"));
        $data = json_decode($jsonContent, true);
    
        // Dispara Job para dicionar registros à tabela de documentos    
        ProcessDocumentImport::dispatch($filePath);
    
        return redirect('/import')->with('status', 'Arquivo enfileirado para importação!');
    }
}
