<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Document</title>
</head>
<body>
    <h2>Upload Document</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="/uploadd" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".doc, .docx, .pdf" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
