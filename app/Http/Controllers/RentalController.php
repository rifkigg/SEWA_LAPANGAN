<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class RentalController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
    
    public function index()
    {
        $now = now()->setTimezone('Asia/Jakarta'); // Waktu sekarang di timezone Asia/Jakarta
        $currentTime = $now->format('H:i:s');      // Format waktu sekarang
        $currentDate = $now->format('Y-m-d');      // Format tanggal sekarang
        
        $rentals = Rental::all();
        // $endTimes = $rentals->pluck('end_time'); // Mengambil semua end_time dari rentals
        // dd($endTimes, $currentTime);
        foreach ($rentals as $rental) {
            // Jika status adalah 'cancelled', lewati rental ini
            if ($rental->status === 'cancelled') {
                continue;
            }
    
            // Jika tanggal pemesanan sama dengan tanggal sekarang
            if ($rental->booking_date === $currentDate) {

                // Jika waktu sekarang lebih besar atau sama dengan `start_time`, ubah status menjadi 'active'
                if ($currentTime >= $rental->start_time && $currentTime < $rental->end_time) {
                    $rental->status = 'active';
                }
                // Jika waktu sekarang lebih besar atau sama dengan `end_time`, ubah status menjadi 'completed'
                else if ($currentTime >= $rental->end_time) {
                    $rental->status = 'completed';
                }
                // Jika waktu sekarang masih kurang dari `start_time`, ubah status menjadi 'pending'
                else if ($currentTime < $rental->start_time) {
                    $rental->status = 'pending';
                }
    
                // Simpan perubahan status
                $rental->save();
            }
            // Jika `booking_date` lebih besar dari tanggal sekarang dan `end_time` sudah lewat, set 'completed'
            else if ($rental->booking_date > $currentDate && $currentTime >= $rental->end_time) {
                $rental->status = 'completed';
                $rental->save();
            }
        }


        return view('pages.rental.rental', compact('rentals'));
    }
    

    public function create($id)
    {
        $field = Field::find($id);
        $fields = Field::all();
        $users = User::all(); // Ambil semua pengguna
        $rentals = Rental::all();
        return view('pages.rental.rental-create', compact('fields', 'field', 'users', 'rentals')); // Kirim pengguna ke view
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'field_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'booking_date' => 'required',
            'total_price' => 'required',
        ]);
        // dd($request->all());
        $rental = new Rental();
        $rental->field_id = $request->field_id;
        $rental->user_id = $request->user_id;
        $rental->status = $request->status;
        $rental->payment_status = $request->payment_status;
        $rental->payment_method = $request->payment_method;
        $rental->start_time = $request->start_time;
        $rental->end_time = $request->end_time;
        $rental->booking_date = $request->booking_date;
        $rental->total_price = $request->total_price;
        $rental->save();

        return redirect()->route('rental.process', $rental->id);
    }

    public function process($id)
    {
        $rental = Rental::find($id);
        if (!$rental) {
            return redirect()->route('rental.index')->with('error', 'Rental tidak ditemukan.');
        }

        // Siapkan parameter untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $rental->id,
                'gross_amount' => $rental->total_price,
            ],
            'customer_details' => [
                'first_name' => $rental->user->username, // Ganti dengan nama user yang sebenarnya
                'email' => $rental->user->email, // Ganti dengan email user yang sebenarnya
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return view('pages.rental.payment', compact('snapToken', 'rental'));
        } catch (\Exception $e) {
            return redirect()->route('rental.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $rental = Rental::find($id);
        $fields = Field::all();
        $users = User::all(); // Ambil semua pengguna
        $rentals = Rental::all();
        return view('pages.rental.rental-edit', compact('rental', 'fields', 'users', 'rentals')); // Kirim pengguna ke view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'field_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'booking_date' => 'required',
            'total_price' => 'required',
        ]);

        $rental = Rental::find($id);
        $rental->update($request->all());
        return redirect()->route('rental.index')->with('success', 'Rental updated successfully.');
    }

    public function destroy($id)
    {
        $rental = Rental::find($id);
        $rental->delete();
        return redirect()->route('rental.index')->with('success', 'Rental deleted successfully.');
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required',
        ]);

        $rental = Rental::find($id);

        // Tambahkan logika untuk mengubah status pembayaran
        if ($request->payment_status === 'unpaid') {
            $rental->payment_status = 'paid';
        } elseif ($request->payment_status === 'paid') {
            $rental->payment_status = 'unpaid';
        }

        $rental->save();

        return redirect()->route('rental.index')->with('success', 'Status rental updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $rental = Rental::find($id);
        $rental->status = 'cancelled';
        $rental->save();

        return redirect()->route('rental.index')->with('success', 'Status rental updated successfully.');
    }
}
