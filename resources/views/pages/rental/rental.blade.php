<x-app-layout>
    <p>Rental</p>
    {{-- <a href="{{ route('rental.create', $field->id) }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Create Rental</a> --}}
    @foreach ($rentals as $rental)
        <table border="1" style="margin-bottom: 30px">
            <tr>
                <td>Rental status</td>
                <td>{{ $rental->status }}</td>
            </tr>
            {{-- Tambahkan pengecekan untuk status cancelled --}}

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
                    <td>Rp {{ number_format($rental->field->price, 0, ',', '.')}} / Jam</td>
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
                    <td>
                        {{ $rental->payment_status }}
                    </td>
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
                    <td>Total harga</td>
                    <td>Rp {{ number_format($rental->total_price, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="display: flex; gap: 10px">
                            <form action="{{ route('rental.destroy', $rental->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('rental.edit', $rental->id) }}">Edit</a>
                                <button type="submit">Delete</button>
                            </form>
                            <form action="{{ route('rental.updatePaymentStatus', $rental->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="payment_status" value="{{ $rental->payment_status }}">
                                <button type="submit"
                                    class="underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">
                                    {{ $rental->payment_status === 'paid' ? 'Mark as Unpaid' : 'Mark as Paid' }}
                                </button>
                            </form>
                            <form action="{{ route('rental.updateStatus', $rental->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{ $rental->status }}">
                                <button type="submit"
                                    class="underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">
                                    Ganti jadi cancelled
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
        </table>
    @endforeach
</x-app-layout>
