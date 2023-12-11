<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
</head>
<body>
    <h1>Image Gallery</h1>

    @foreach ($images as $image)
        <div>
            <img src="{{ $image['url'] }}" alt="{{ $image['name'] }}">
            <p>Image Name: {{ $image['name'] }}</p>
            <p>Image URL: {{ $image['url'] }}</p>
        </div>
    @endforeach
</body>
</html>
