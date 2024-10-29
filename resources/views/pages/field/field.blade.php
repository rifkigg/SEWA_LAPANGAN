<x-app-layout>
    {{-- <button onclick="history.back()">Back</button> --}}
    <a href="{{ route('field.create') }}">Tambah Lapangan</a>
    <table border="1" id="dataTables" class="display dark:text-white" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-left">Nama Lapangan</th>
                <th class="text-right">Harga</th>
                <th class="text-left">Lokasi</th>
                <th class="text-left">Deskripsi</th>
                <th class="text-left">Owner</th>
                <th class="text-left">Gambar Lapangan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fields as $field)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $field->name }}</td>
                    <td class="text-right">{{ number_format($field->price, 0, ',', '.') }} / Jam</td>
                    <td class="text-left">{{ $field->location }}</td>
                    <td class="text-left">{{ $field->description }}</td>
                    <td class="text-left">{{ $field->owner->username }}</td>
                    <td class="text-center">
                        <img src="{{ asset('storage/' . $field->image) }}" alt="{{ $field->image }}" width="100px">
                    </td>
                    <td class="text-center">
                        <form action="{{ route('field.destroy', $field->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?');">
                            <a href="{{ route('field.edit', $field->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
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
                        targets: 2,
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
