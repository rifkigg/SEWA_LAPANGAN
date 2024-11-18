<x-app-layout>
    <div class="container mx-auto mt-10">
        <a href="{{ route('home') }}" class="inline-block mb-5 text-blue-500 hover:text-blue-700">Back</a>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="{{ asset('storage/'.$field->image) }}" class="w-full h-64 object-cover" alt="image">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2">{{ $field->name }}</h2>
                <p class="text-gray-700 mb-2"><strong>Price:</strong> Rp {{ number_format($field->price, 0, ',', '.') }} / Jam</p>
                <p class="text-gray-700 mb-2"><strong>Location:</strong></p>
                {{-- <div id="map" style="height: 300px;"></div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var location = "{{ $field->location }}".split(',');
                        var latitude = parseFloat(location[0]);
                        var longitude = parseFloat(location[1]);

                        var map = L.map('map').setView([latitude, longitude], 13);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        L.marker([latitude, longitude]).addTo(map)
                            .bindPopup('{{ $field->name }}')
                            .openPopup();
                    });
                </script> --}}
                <?php
                    $location = explode(',', $field->location);
                    $latitude = trim($location[0]);
                    $longitude = trim($location[1]);
                ?>
                <iframe
                    width="600"
                    height="450"
                    style="border:0;"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}&hl=es;z=14&output=embed">
                </iframe>
                <p class="text-gray-700 mb-2"><strong>Description:</strong> {{ $field->description }}</p>
                <p class="text-gray-700 mb-4"><strong>Owner:</strong> {{ $field->owner->username }}</p>
                <a href="{{ route('rental.create', $field->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Sewa Lapangan</a>
            </div>
        </div>
    </div>
</x-app-layout>