<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Lapangan yang anda sewa') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Disini anda dapat melihat lapangan yang anda sewa') }}
        </p>
    </header>

    @forelse ($rentals as $rental)
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg dark:text-white relative">
            <div class="font-bold absolute top-1 left-1 dark:bg-white dark:text-gray-800 bg-gray-800 text-white w-8 h-8 rounded-full flex items-center justify-center">{{ $loop->iteration }}</div>
            <p>Nama Lapangan : {{ $rental->field->name }}</p>
            <p>Lokasi Lapangan : {{ $rental->field->location }}</p>
            <p>Total Harga : Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p>
            <p>Waktu Mulai : {{ \Carbon\Carbon::parse($rental->booking_date)->locale('id')->translatedFormat('l') }}
                {{ \Carbon\Carbon::parse($rental->booking_date)->format('d/m/Y') }} Jam 
                {{ \Carbon\Carbon::parse($rental->start_time)->format('H:i') }} -
                {{ \Carbon\Carbon::parse($rental->end_time)->format('H:i') }} WIB</p>
            <p>Status : {{ $rental->status == 'pending' ? 'Belum Mulai' : ($rental->status == 'active' ? 'Sedang Bermain' : ($rental->status == 'completed' ? 'Selesai' : 'Dibatalkan')) }}</p>
            <p>Waktu Menyewa : {{ $rental->created_at->format('d-m-Y H:i') }}</p>
            <p class="{{ $rental->payment_status == 'paid' ? 'text-green-500' : 'text-red-500' }}">Status Pembayaran : {{ $rental->payment_status == 'paid' ? 'Lunas' : 'Belum Lunas' }}</p>
        </div>
    @empty
        <p>Kamu belum nyewa lapangan</p>
    @endforelse

</section>
