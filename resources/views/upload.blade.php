<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <form action="{{ route('upload.image') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="image">Select Image:</label>
         <input type="file" name="image">
        <button type="submit">Upload</button>
    </form>
</body>

</html>
