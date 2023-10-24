<!-- resources/views/process-queue.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Queue</title>
</head>
<body>
    <h1>Process Queue</h1>

    @if(session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <form action="/process-queue" method="post">
        @csrf
        <button type="submit">Processar Fila</button>
    </form>

    <h2>Arquivos na Fila:</h2>
    @if(count($queueFiles) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th>Nome do Arquivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($queueFiles as $file)
                    <tr>
                        <td>{{ basename($file) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum arquivo na fila.</p>
    @endif
</body>
</html>
