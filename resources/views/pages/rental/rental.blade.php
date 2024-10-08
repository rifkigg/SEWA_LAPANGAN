<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental</title>
</head>
<body>
    <p>Rental</p>
    <a href="{{ route('rental.create') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Create Rental</a>
    @foreach ($rentals as $rental)
        <p>Rental status : {{ $rental->status }}</p>
        <p>User yang nyewa : {{ $rental->user->username }}</p>
        <p>Nama lapangan yang di sewa : {{ $rental->field->name }}</p>
        <p>Lokasi lapangan yang di sewa : {{ $rental->field->location }}</p>
        <p>Harga lapangan yang di sewa : {{ $rental->field->price }}</p>
        <p>Deskripsi lapangan yang di sewa : {{ $rental->field->description }}</p>
        <p>Pemilik lapangan yang di sewa : {{ $rental->field->owner->username }}</p>
        <p>Image lapangan yang di sewa : </p>
        <img src="{{ asset('storage/' . $rental->field->image) }}" alt="{{ $rental->field->image }}">
        <p>Status pembayaran lapangan : {{ $rental->payment_status }}</p>
        <p>Metode pembayaran yang digunakan : {{ $rental->payment_method }}</p>
        <p>Waktu mulai sewa : {{ $rental->start_time }}</p>
        <p>Waktu akhir sewa : {{ $rental->end_time }}</p>
        <p>Tanggal sewa : {{ $rental->booking_date }}</p>
        <form action="{{ route('rental.destroy', $rental->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <a href="{{ route('rental.edit', $rental->id) }}">Edit</a>
            <button type="submit">Delete</button>
        </form>
    @endforeach
</body>
</html>