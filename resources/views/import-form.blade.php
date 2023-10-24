<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Form</title>
</head>
<body>
    <h1>Import Documents</h1>

    @if(session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <form action="/import" method="post" enctype="multipart/form-data">
        @csrf
        <label for="file">Choose a JSON file:</label>
        <input type="file" name="file" accept=".json" required>
        <button type="submit">Import</button>
    </form>
</body>
</html>
