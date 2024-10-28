<x-app-layout>
    <p>Kamu Menyewa Lapangan : <span style="font-weight: bold;font-size: 1.5rem">{{ $field->name }}</span></p>
    <a href="{{ route('rental.index') }}"
        class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Back</a>
    <form action="{{ route('rental.store') }} " method="POST" enctype="multipart/form-data"
        style="display: flex;flex-direction: column">
        @csrf
        <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
        <input type="text" name="field_id" value="{{ $field->id }}" hidden>
        {{-- <select name="field_id" id="field_id">
            @foreach ($fields as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select> --}}
        <input type="text" name="status" id="status" value="pending" hidden>
        <input type="text" name="payment_status" id="payment_status" value="unpaid" hidden>
        <label for="payment_method">Payment Method</label>
        <select name="payment_method" id="payment_method">
            <option value="" selected disabled>Pilih Metode Pembayaran</option>
            <option value="cash">Cash</option>
            <option value="midtrans">Kredit</option>
        </select>
        <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
        <label for="start_time">Start Time</label>
        <input type="time" name="start_time" id="start_time" readonly>
        <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
        <label for="start_time">Jam Mulai</label>
        <select id="jam_awal">
            <option value="" disabled selected>Jam</option>
            <script>
                for (let i = 0; i < 24; i++) {
                    document.write(`<option value="${i.toString().padStart(2, '0')}">${i.toString().padStart(2, '0')}:00</option>`);
                }
            </script>
        </select>
        <label for="durasi_main">Durasi Main</label>
        <select name="hours" id="durasi_main">
            <option value="" disabled selected>Pilih Durasi</option>
            <script>
                const jam_awal = document.getElementById('jam_awal');
                jam_awal.addEventListener('change', function() {
                    const startTimeInput = document.getElementById('start_time');

                    // Set nilai start_time berdasarkan jam yang dipilih
                    startTimeInput.value = jam_awal.value + ':00';

                    const valueStartTime = startTimeInput.value;
                    const startTime = parseInt(valueStartTime.slice(0, 2));
                    console.log(startTime); // Pastikan log ini muncul
                    
                    const maxHours = 24 - startTime; // Menghitung sisa jam dalam sehari
                    const durasiSelect = document.getElementById('durasi_main');
                    durasiSelect.innerHTML = '<option value="" disabled selected>Pilih Durasi</option>'; // Reset opsi

                    // Validasi untuk memastikan maxHours tidak negatif
                    if (maxHours > 0) {
                        for (let i = 1; i <= maxHours; i++) {
                            durasiSelect.innerHTML += `<option value="${i.toString().padStart(2, '0')}">${i.toString().padStart(2, '0')} Jam</option>`;
                        }
                    }
                });
            </script>
        </select>
        {{-- <p>{{ $field->price }}</p> --}}
        <label for="end_time">End Time</label>
        <input type="time" name="end_time" id="end_time" readonly>
        <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
        <label for="booking_date">Date</label>
        <input type="date" name="booking_date" id="booking_date">
        <x-input-error :messages="$errors->get('booking_date')" class="mt-2" />
        <input type="number" name="total_price" id="total_price" hidden>
        <button type="submit">Submit</button>
    </form>

    <p id="result"></p>

    <script>
        // Add event listener to hour and hours select
        document.addEventListener('DOMContentLoaded', function() {
            const startTimeInput = document.getElementById('start_time');
            const durasiMain = document.getElementById('durasi_main');
            const jam_awal = document.getElementById('jam_awal');
            const endTimeInput = document.getElementById('end_time');
            const totalPrice = document.getElementById('total_price');
            const result = document.getElementById('result');

            function updateEndTime() {
                const startTime = startTimeInput.value;
                const hours = parseInt(durasiMain.value);
                if (startTime && hours) {
                    const startDate = new Date(`1970-01-01T${startTime}:00`);
                    startDate.setHours(startDate.getHours() + hours);
                    endTimeInput.value = startDate.toTimeString().slice(0, 5);
                }
            }

            function updateResult() {
                const startTime = startTimeInput.value;
                const endTime = endTimeInput.value;
                if (startTime && endTime) {
                    let selisih = parseInt(endTime.slice(0, 2)) - parseInt(startTime.slice(0, 2));
                    
                    // Tambahkan logika untuk menangani perubahan hari
                    if (selisih < 0) {
                        selisih += 24; // Tambahkan 24 jam jika endTime lebih kecil dari startTime
                    }

                    let harga = selisih * {{ $field->price }};
                    // Format harga menjadi format rupiah tanpa koma
                    result.innerHTML = 'Total Harga: ' + 'Rp ' + harga.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
                    totalPrice.value = harga;
                } else {
                    result.innerHTML = 'Total Harga: 0';
                }
            }

            jam_awal.addEventListener('change', function() {
                startTimeInput.value = jam_awal.value + ':00';
                updateEndTime();
                updateResult();
            });

            durasiMain.addEventListener('change', function() {
                updateEndTime();
                updateResult();
            });
            
            updateResult();
        });

        function validateInputs() {
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;
            const bookingDate = document.getElementById('booking_date').value;
            let errorMessage = '';

            if (!startTime) {
                errorMessage += 'Jam mulai harus diisi.<br>';
            }
            if (!endTime) {
                errorMessage += 'Jam selesai harus diisi.<br>';
            }
            if (!bookingDate) {
                errorMessage += 'Tanggal harus diisi.<br>';
            }

            if (errorMessage) {
                document.getElementById('error_message').innerHTML = errorMessage;
                return false; // Mengembalikan false jika ada kesalahan
            }
            document.getElementById('error_message').innerHTML = ''; // Menghapus pesan kesalahan jika tidak ada
            return true; // Mengembalikan true jika semua input valid
        }

        document.querySelector('form').addEventListener('submit', function(event) {
            if (!validateInputs()) {
                event.preventDefault(); // Mencegah pengiriman form jika ada kesalahan
            }
        });
    </script>
    </x-app-layout>