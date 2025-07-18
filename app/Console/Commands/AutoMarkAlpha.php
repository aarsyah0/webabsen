<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Presensi;
use Carbon\Carbon;

class AutoMarkAlpha extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presensi:mark-alpha';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Otomatis menandai presensi alfa bagi user yang belum absen hingga jam 13:00';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today       = Carbon::now('Asia/Jakarta')->toDateString();
        $cutOffTime  = Carbon::createFromTime(13, 0, 0, 'Asia/Jakarta');

        // Pastikan kita memang sudah lewat jam 13:00
        if (Carbon::now('Asia/Jakarta')->lt($cutOffTime)) {
            $this->info('Belum waktunya: masih sebelum jam 13:00');
            return 0;
        }

        // Ambil semua user (atau filter sesuai role/kelas dsb.)
        $users = User::all();

        foreach ($users as $user) {
            // Cek apakah user sudah presensi hari ini
            $hasCheckedIn = $user->presensis()
                                 ->whereDate('waktu', $today)
                                 ->exists();

            if (! $hasCheckedIn) {
                Presensi::create([
                    'user_id' => $user->id,
                    'waktu'   => Carbon::now('Asia/Jakarta'),
                    'status'  => 'alfa',
                    'lat'     => 0,
                    'long'    => 0,
                ]);
                $this->info("User ID {$user->id} ditandai ALFA.");
            }
        }

        $this->info('Proses penandaan alfa selesai.');
        return 0;
    }
}
