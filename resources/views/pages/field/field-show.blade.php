<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $field->name }}</title>
</head>
<body>
    <p>Show Lapangan</p>
    <a href="{{ route('home') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Back</a>
    <p>Name : {{ $field->name }}</p>
    <p>Price : Rp {{ number_format($field->price, 0, ',', '.') }} / Jam</p>
    <p>Location : {{ $field->location }}</p>
    <p>Description : {{ $field->description }}</p>
    <p>Owner : {{ $field->owner->username }}</p>
    <p>Image : <img src="{{ asset('storage/'.$field->image) }}" alt="image"></p>
    <a href="{{ route('rental.create', $field->id) }}">Sewa Lapangan</a>
</body>
</html>