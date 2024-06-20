<!DOCTYPE html>
<html>
<head>
    <title>{{ $film->film_title }}</title>
</head>
<body>
    <h1>{{ $film->film_title }}</h1>
    <p>{{ $film->film_outline }}</p>
    <img src="{{ $film->film_picture }}" alt="{{ $film->film_title }}">
    <p>レビュー数: {{ $film->review_count }}</p>
    <p>総合評価: {{ number_format($film->reviews_total, 2) }}</p>
    <p>いいね数: {{ $film->like_count }}</p>

    @auth
        <form method="POST" action="{{ url('/films', $film->id) }}/like">
            @csrf
            <button type="submit">いいね</button>
        </form>

        <form method="POST" action="{{ url('/films', $film->id) }}/review">
            @csrf
            <label for="rating">評価 (1-5):</label>
            <input type="number" name="rating" min="1" max="5" required>
            <label for="review">レビュー:</label>
            <textarea name="review"></textarea>
            <button type="submit">送信</button>
        </form>
    @endauth

    <h2>レビュー</h2>
    <ul>
        @foreach ($film->reviews as $review)
            <li>
                <strong>{{ $review->user->name }}</strong>:
                <p>評価: {{ $review->rating }}</p>
                <p>{{ $review->review }}</p>
            </li>
        @endforeach
    </ul>
</body>
</html>
