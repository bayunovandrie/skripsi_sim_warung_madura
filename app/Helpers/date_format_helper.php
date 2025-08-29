<?php

if (!function_exists('return_date_format')) {
    function return_date_format($tanggal)
    {
        $hari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];

        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        ];

        $tgl = date('d', strtotime($tanggal));
        $bln = date('n', strtotime($tanggal));
        $thn = date('Y', strtotime($tanggal));
        $hr  = date('l', strtotime($tanggal)); // ambil nama hari (Sunday - Saturday)

        return $hari[$hr] . ', ' . $tgl . ' ' . $bulan[$bln] . ' ' . $thn;
    }

    function return_datetime_format($tanggal)
    {
        $hari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];

        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        ];

        $tgl = date('d', strtotime($tanggal));
        $bln = date('n', strtotime($tanggal));
        $thn = date('Y', strtotime($tanggal));
        $hr  = date('l', strtotime($tanggal)); 
        $jam = date('H:i', strtotime($tanggal));

        return $hari[$hr] . ', ' . $tgl . ' ' . $bulan[$bln] . ' ' . $thn . " " . $jam . " WIB";
    }
}