@props([
    'title' => 'Laracasts'

])

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <style>
        .max-w-400 {
            max-width: 400px;
            margin: auto;
        }
        .card {
            background-color: springgreen;
            padding: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/">inicio</a>
        <a href="about">About me</a>
        <a href="contact">Contact Us</a>
    </nav>
    <main>
        {{ $slot }}
    </main>
</body>
</html>
