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
        $request->validate([
            'lat'  => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        // Pastikan setting ada
        if (is_null($this->schoolLat) || is_null($this->schoolLong) || is_null($this->radius)) {
            return response()->json(['error' => 'Konfigurasi wilayah sekolah belum diatur'], 500);
        }

        $user = $request->user();
        $lat  = $request->lat;
        $long = $request->long;

        $distance = $this->haversine($lat, $long, $this->schoolLat, $this->schoolLong);

        if ($distance > $this->radius) {
            return response()->json(['error' => 'Diluar area sekolah'], 403);
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
