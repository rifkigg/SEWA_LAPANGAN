<x-app-layout>
    <p>Rental</p>
    {{-- <a href="{{ route('rental.create', $field->id) }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Create Rental</a> --}}
    <table border="1" id="dataTables" class="display dark:text-white">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-left">Nama</th>
                <th class="text-left">Status</th>
                <th class="text-left">Nama Lapangan</th>
                <th class="text-right">Harga</th>
                <th class="text-left">Owner</th>
                <th class="text-left">Status Pembayaran</th>
                <th class="text-left">Metode Pembayaran</th>
                <th class="text-left">Tanggal Sewa</th>
                <th class="text-right">Total Harga</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $rental->user->username }}</td>
                    <td class="text-left">
                        {{ 
                            $rental->status === "completed" ? "Selesai" : 
                            ($rental->status === "cancelled" ? "Dibatalkan" : 
                            ($rental->status === "pending" ? "Belum Mulai" : 
                            "Sedang Bermain")) 
                        }}
                    </td>
                    <td class="text-left">{{ $rental->field->name }}</td>
                    <td class="text-right">{{ number_format($rental->field->price, 0, ',', '.') }} / Jam</td>
                    <td class="text-left">{{ $rental->field->owner->username }}</td>
                    {{-- <td><img src="{{ asset('storage/' . $rental->field->image) }}" alt="{{ $rental->field->image }}"></td> --}}
                    <td class="text-left">{{ $rental->payment_status == 'paid' ? 'Lunas' : 'Belum Lunas' }}</td>
                    <td class="text-left">{{ $rental->payment_method == 'cash' ? 'Tunai' : 'Kredit' }}</td>
                    <td class="text-left">
                        {{ \Carbon\Carbon::parse($rental->booking_date)->locale('id')->translatedFormat('l') }}
                        {{ \Carbon\Carbon::parse($rental->booking_date)->format('d/m/Y') }}
                        {{ \Carbon\Carbon::parse($rental->start_time)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($rental->end_time)->format('H:i') }}</td>
                    <td class="text-right">{{ number_format($rental->total_price, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <div style="display: flex; gap: 10px">
                            <form action="{{ route('rental.destroy', $rental->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus rental ini?');">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('rental.edit', $rental->id) }}">Edit</a>
                                <button type="submit">Hapus</button>
                            </form>
                            <form action="{{ route('rental.updatePaymentStatus', $rental->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="payment_status" value="{{ $rental->payment_status }}">
                                <button type="submit"
                                    class="underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">
                                    {{ $rental->payment_status === 'paid' ? 'Ubah ke Belum Lunas' : 'Ubah ke Lunas' }}
                                </button>
                            </form>
                            <form action="{{ route('rental.updateStatus', $rental->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{ $rental->status }}">
                                <button type="submit"
                                    class="underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">
                                    Ganti jadi Batal
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable({
                paging: false, // Menonaktifkan pagination
                lengthChange: false, // Menyembunyikan dropdown "entries per page"
                info: false, // Menyembunyikan informasi "Showing X to Y of Z entries"
                searching: false, // Menyembunyikan search bar
                columnDefs: [{
                        targets: [0, 6, 7],
                        className: 'text-center'
                    }, // No, Image, Action
                    {
                        targets: 4,
                        className: 'text-right'
                    } // Price
                ],
                dom: 't',
                language: {
                    emptyTable: "No data available" // Mengatur pesan jika tabel kosong
                }
            });
        });
    </script>

    <style>
        /* Custom CSS untuk memastikan align bekerja */
        th.text-right,
        td.text-right {
            text-align: right !important;
        }

        th.text-center,
        td.text-center {
            text-align: center !important;
        }

        th.text-left,
        td.text-left {
            text-align: left !important;
        }

        .dataTables_length,
        .dataTables_info,
        .dataTables_filter {
            display: none !important;
        }
    </style>
</x-app-layout>
