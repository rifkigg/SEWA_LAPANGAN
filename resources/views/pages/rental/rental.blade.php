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
    {{-- <a href="{{ route('rental.create', $field->id) }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Create Rental</a> --}}
    @foreach ($rentals as $rental)
        <table border="1" style="margin-bottom: 30px">
            <tr>
                <td>Rental status</td>
                <td>{{ $rental->status }}</td>
            </tr>
            <tr>
                <td>User yang nyewa</td>
                <td>{{ $rental->user->username }}</td>
            </tr>
            <tr>
                <td>Nama lapangan yang di sewa</td>
                <td>{{ $rental->field->name }}</td>
            </tr>
            <tr>
                <td>Lokasi lapangan yang di sewa</td>
                <td>{{ $rental->field->location }}</td>
            </tr>
            <tr>
                <td>Harga lapangan yang di sewa</td>
                <td>{{ $rental->field->price }}</td>
            </tr>
            <tr>
                <td>Deskripsi lapangan yang di sewa</td>
                <td>{{ $rental->field->description }}</td>
            </tr>
            <tr>
                <td>Pemilik lapangan yang di sewa</td>
                <td>{{ $rental->field->owner->username }}</td>
            </tr>
            <tr>
                <td>Image lapangan yang di sewa</td>
                <td><img src="{{ asset('storage/' . $rental->field->image) }}" alt="{{ $rental->field->image }}"></td>
            </tr>
            <tr>
                <td>Status pembayaran lapangan</td>
                <td>{{ $rental->payment_status }}</td>
            </tr>
            <tr>
                <td>Metode pembayaran yang digunakan</td>
                <td>{{ $rental->payment_method }}</td>
            </tr>
            <tr>
                <td>Waktu mulai sewa</td>
                <td>{{ $rental->start_time }}</td>
            </tr>
            <tr>
                <td>Waktu akhir sewa</td>
                <td>{{ $rental->end_time }}</td>
            </tr>
            <tr>
                <td>Tanggal sewa</td>
                <td>{{ $rental->booking_date }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <form action="{{ route('rental.destroy', $rental->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('rental.edit', $rental->id) }}">Edit</a>
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        </table>
    @endforeach
</body>
</html>