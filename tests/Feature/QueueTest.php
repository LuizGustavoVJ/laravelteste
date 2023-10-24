<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;
use App\Jobs\ProcessDocumentImport;

class QueueTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Executar as migrações e configurar o ambiente de teste
        Artisan::call('migrate');

        // Fingir a fila para simular a execução síncrona
        Bus::fake();
    }

    /** @test */
    public function it_can_process_queue_and_remove_processed_files()
    {
        // Adicionar alguns arquivos à fila
        $file1 = '2023-03-28.json';
        $file2 = '2023-03-29.json';
        Storage::put("data/{$file1}", '{"exercicio": 2023, "documentos": []}');
        Storage::put("data/{$file2}", '{"exercicio": 2023, "documentos": []}');

        // Enfileirar o trabalho diretamente, simulando o envio para a fila
        ProcessDocumentImport::dispatch(storage_path("app/data/{$file1}"));
        ProcessDocumentImport::dispatch(storage_path("app/data/{$file2}"));

        // Executar os trabalhos da fila
        Artisan::call('queue:work', ['--once' => true]);

        // Verificar se os arquivos foram removidos após o processamento
        $response = $this->get('/queue');
        $response->assertDontSee($file1);
        $response->assertDontSee($file2);

        // Verificar se os trabalhos foram adicionados à fila corretamente
        Bus::assertDispatched(ProcessDocumentImport::class, function ($job) use ($file1) {
            return $job->getFilePath() === storage_path("app/data/{$file1}");
        });

        Bus::assertDispatched(ProcessDocumentImport::class, function ($job) use ($file2) {
            return $job->getFilePath() === storage_path("app/data/{$file2}");
        });

        // Verificar se a fila foi executada corretamente
        Bus::assertDispatched(ProcessDocumentImport::class, 2); // O número 2 representa a quantidade de vezes que o trabalho deve ser despachado
    }
}
