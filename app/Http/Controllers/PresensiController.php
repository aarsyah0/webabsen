<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    protected $schoolLat;
    protected $schoolLong;
    protected $radius;

    public function __construct()
    {
        // Ambil semua setting dalam bentuk ['key' => 'value']
        $settings = Setting::pluck('value', 'key')->all();

        // Cast ke tipe yang benar
        $this->schoolLat  = isset($settings['school_lat'])   ? (float) $settings['school_lat']   : null;
        $this->schoolLong = isset($settings['school_long'])  ? (float) $settings['school_long']  : null;
        $this->radius     = isset($settings['school_radius'])? (int)   $settings['school_radius'] : null;
    }

    public function store(Request $request)
{
    $user = $request->user();

    // Jika ada status sakit/izin, proses tanpa cek lokasi
    if ($request->has('status') && in_array($request->status, ['sakit', 'izin'])) {
        // Validasi opsional lat/long
        $request->validate([
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
        ]);
        // Cek sudah presensi hari ini
        $today = now()->toDateString();
        $alreadyPresent = $user->presensis()->whereDate('waktu', $today)->exists();

        if ($alreadyPresent) {
            return response()->json(['error' => 'Anda sudah melakukan presensi hari ini'], 403);
        }

        $presensiData = [
            'user_id' => $user->id,
            'waktu'   => now(),
            'status'  => $request->status,
        ];
        // Simpan lat/long jika ada
        if ($request->filled('lat')) {
            $presensiData['lat'] = $request->lat;
        }
        if ($request->filled('long')) {
            $presensiData['long'] = $request->long;
        }

        $presensi = Presensi::create($presensiData);

        return response()->json([
            'message' => 'Presensi ' . $request->status . ' berhasil',
            'data'    => $presensi
        ]);
    }

    // ...lanjutkan kode lama untuk presensi hadir (lokasi)
    $request->validate([
        'lat'  => 'required|numeric',
        'long' => 'required|numeric',
    ]);

    // Pastikan setting ada
    if (is_null($this->schoolLat) || is_null($this->schoolLong) || is_null($this->radius)) {
        return response()->json(['error' => 'Konfigurasi wilayah sekolah belum diatur'], 500);
    }

    $lat  = $request->lat;
    $long = $request->long;

    $distance = $this->haversine($lat, $long, $this->schoolLat, $this->schoolLong);

    if ($distance > $this->radius) {
        return response()->json(['error' => 'Lokasi di luar jangkauan'], 403);
    }

    // Cek apakah user sudah presensi hari ini
    $today = now()->toDateString();
    $alreadyPresent = $user->presensis()->whereDate('waktu', $today)->exists();

    if ($alreadyPresent) {
        return response()->json(['error' => 'Anda sudah melakukan presensi hari ini'], 403);
    }

    $presensi = Presensi::create([
        'user_id' => $user->id,
        'waktu'   => now(),
        'lat'     => $lat,
        'long'    => $long,
        'status'  => 'hadir',
    ]);

    return response()->json([
        'message' => 'Presensi berhasil',
        'data'    => $presensi
    ]);
}


    public function index(Request $request)
    {
        $user    = $request->user();
        $riwayat = $user->presensis()->orderBy('waktu', 'desc')->get();

        return response()->json($riwayat);
    }

    private function haversine($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meter
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2)**2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2)**2;
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadius * $c;
    }
}
