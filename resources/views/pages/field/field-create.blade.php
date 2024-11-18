<x-app-layout>
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
        <button class="px-5 py-2 bg-pink-600 rounded-lg mb-5 text-white font-semibold hover:bg-pink-400" onclick="window.history.back()">Back</button>
        <h1 class="text-2xl font-bold mb-6">Tambah Lapangan</h1>
        <form action="{{ route('field.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" placeholder="Nama Lapangan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="text" name="price" id="price" placeholder="Harga/Jam" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <!-- Search Box -->
                <input id="search-box" type="text" placeholder="Pencarian Lokasi" 
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <!-- Map -->
                <div id="map" style="height: 300px; margin-top: 10px;"></div>
                <!-- Hidden Input to store the location -->
                <input type="hidden" name="location" id="location">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" placeholder="Deskripsi lapangan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <div>
                <label for="owner" class="block text-sm font-medium text-gray-700">Pemilik</label>
                <select name="owner_id" id="owner_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected disabled>Pemilik</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                {{-- <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500"> --}}
                <input type="file" id="image" name="image" accept="image/*" class="p-2 mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Submit</button>
        </form>
    </div>

    {{-- <!-- Leaflet.js --> --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" /> --}}
    {{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script> --}}
    {{-- <!-- Leaflet Geocoder --> --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" /> --}}
    {{-- <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Initialize map
            const map = L.map('map').setView([-6.1754, 106.8272], 12); // Default: Jakarta
            
            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add marker
            let marker = L.marker([-6.1754, 106.8272], { draggable: true }).addTo(map);

            // Update hidden input when marker is moved
            marker.on('moveend', function (e) {
                const { lat, lng } = e.target.getLatLng();
                updateLocationField(lat, lng);
            });

            // Handle map click to move marker
            map.on('click', function(e) {
                const { lat, lng } = e.latlng;
                marker.setLatLng(e.latlng); // Move marker to the clicked location
                updateLocationField(lat, lng);
            });

            // Initialize geocoder
            const geocoder = L.Control.Geocoder.nominatim();

            // Add event listener for search box
            const searchBox = document.getElementById('search-box');
            searchBox.addEventListener('change', function() {
                console.log('Searching for:', searchBox.value); // Debugging log
                geocoder.geocode(searchBox.value, function(results) {
                    console.log('Geocode results:', results); // Debugging log
                    if (results.length > 0) {
                        const result = results[0];
                        map.setView(result.center, 15);
                        marker.setLatLng(result.center);
                        updateLocationField(result.center.lat, result.center.lng, result.name);
                    }
                });
            });

            // Update location field
            function updateLocationField(lat, lng, address = '') {
                const locationInput = document.getElementById('location');
                locationInput.value = `${lat}, ${lng}`;
                if (address) {
                    locationInput.value += ` (${address})`;
                }
            }
        });
    </script>
</x-app-layout>
