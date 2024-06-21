<!DOCTYPE html>
<html>
<head>
    <title>Now Playing Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Now Playing Movies</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($movies as $movie)
                <div class="border rounded-lg p-4">
                    <h2 class="text-xl font-semibold">{{ $movie['title'] }}</h2>
                    <p>{{ $movie['overview'] }}</p>
                    <p><strong>Release Date:</strong> {{ $movie['release_date'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>