<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class M_proses_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_proses')->insert([
            [
                'id_m_proses' => 1,
                'nm_m_proses' => 'Pengisian Data Diri',
                'urut_m_proses' => 1,
            ],
            [
                'id_m_proses' => 2,
                'nm_m_proses' => 'Pengisian Metode Bayar',
                'urut_m_proses' => 2,
            ],
            [
                'id_m_proses' => 3,
                'nm_m_proses' => 'Pembayaran',
                'urut_m_proses' => 3
            ],
            [
                'id_m_proses' => 4,
                'nm_m_proses' => 'Konfirmasi Pembayaran',
                'urut_m_proses' => 4
            ],
            [
                'id_m_proses' => 5,
                'nm_m_proses' => 'Verifikasi Pembayaran',
                'urut_m_proses' => 5
            ],
            [
                'id_m_proses' => 6,
                'nm_m_proses' => 'Transaksi Selesai',
                'urut_m_proses' => 6
            ],
        ]);
    }
}
