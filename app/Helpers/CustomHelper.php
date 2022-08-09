<?php
function changeDateFormate($date, $date_format)
{
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
}

if (!function_exists('tanggal')) {
    /**
     * Convert tanggal
     *
     * @param [string] $date, $date_format
     * @return void
     */
    function tanggal($date, $date_format)
    {
        return ($date == '' || $date == "''" || empty($date) || $date == null) ? null : htmlspecialchars(\Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format));
    }
}

if (!function_exists('rupiah')) {
    function rupiah($angka){
        $hasil = "IDR " . number_format($angka,0,',','.');
        return $hasil;
    }
}

if (!function_exists('romawi')) {
    /**
     * Convert Romawi
     *
     * @param [int] $num
     */
    function romawi($n){
        $hasil = "";
        $iromawi = array("","I","II","III","IV","V","VI","VII","VIII","IX","X",20=>"XX",30=>"XXX",40=>"XL",50=>"L",
        60=>"LX",70=>"LXX",80=>"LXXX",90=>"XC",100=>"C",200=>"CC",300=>"CCC",400=>"CD",500=>"D",600=>"DC",700=>"DCC",
        800=>"DCCC",900=>"CM",1000=>"M",2000=>"MM",3000=>"MMM");
        if(array_key_exists($n,$iromawi)){
            $hasil = $iromawi[$n];
            }elseif($n >= 11 && $n <= 99){
            $i = $n % 10;
            $hasil = $iromawi[$n-$i] . Romawi($n % 10);
            }elseif($n >= 101 && $n <= 999){
            $i = $n % 100;
            $hasil = $iromawi[$n-$i] . Romawi($n % 100);
            }else{
            $i = $n % 1000;
            $hasil = $iromawi[$n-$i] . Romawi($n % 1000);
        }
        return $hasil;
    }
}

if (!function_exists('random_string')) {
    /**
     * random_string
     *
     * @param [string]
     * @return void
     */
    function random_string($length)
    {
        $str_result = '23456789ABCDEFGHJKLMNPRSTUVWXYZ';
        return substr(str_shuffle($str_result),0, $length);
    }
}

if (!function_exists('terbilang')) {
    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = penyebut($nilai - 10) . " Belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai / 10) . " Puluh" . penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai / 100) . " Ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai / 1000) . " Ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai / 1000000) . " Juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai / 1000000000) . " Milyar" . penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai / 1000000000000) . " Trilyun" . penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return $hasil;
    }
}

if (!function_exists('is_angka_pecahan')) {
    function is_angka_pecahan($val)
    {
        return is_numeric($val) && floor($val) != $val;
    }
}

if (!function_exists('terbilang_dan_decimal')) {


    function terbilang_dan_decimal($nilai = null)
    {
        if ($nilai == null) {
            return 'function terbilang error : variabel nilai angka belum diisi !';
        } else {
            if (!is_numeric($nilai)) {
                return 'function terbilang error : harus berupa angka numerik !';
            } else {
                if ($nilai < 0) {
                    $hasil = "minus " . trim(penyebut($nilai));
                } else {
                    if (is_angka_pecahan($nilai)) {
                        // pecah by dot
                        $arr_pecah = explode('.', $nilai);
                        $hasil = trim(penyebut($nilai)) . ' Koma ' . penyebut($arr_pecah[1]);
                    } else {
                        $hasil = trim(penyebut($nilai));
                    }
                }
                return $hasil;
            }
        }
    }
}

if (!function_exists('rute_asal')) {
    function rute_asal($val=null)
    {
        $_init = explode('.', Route::currentRouteName());
        $_count = count($_init);
        $route = array_slice($_init, 0, $_count - 1, true);
        $rute = implode('.', $route) . '.';
        return $rute.($val ?? null);
    }
}

if (!function_exists('rute_sekarang')) {
    function rute_sekarang($val=null)
    {
        $_init = explode('.', Route::currentRouteName());
        $_count = count($_init);
        $route = array_slice($_init, 0, $_count, true);
        $rute = implode('.', $route);
        return $rute.($val ?? null);
    }
}

if (!function_exists('last_route')) {
    function last_route($val=null)
    {
        $_init = explode('.', Route::currentRouteName());
        return last($_init);
    }
}

if(!function_exists('contul'))
{
    /**
     * Convert empty string to null (input text)
     *
     * @param [type] $string
     * @return void
     */
    function contul($string)
    {
        if (filter_var($string, FILTER_VALIDATE_EMAIL)) {
                return ($string == '' || $string == "''" || empty($string) || $string==null) ? null : $string;
        }else{
            if(is_array($string)){
                return ($string == '' || $string == "''" || empty($string) || $string==null) ? null : \Str::upper($string[0]);
            }else{
                return ($string == '' || $string == "''" || empty($string) || $string==null) ? null : \Str::upper($string);
            }
        }

        // return ($string == '' || $string == "''" || empty($string) || $string==null) ? null : htmlspecialchars(\Str::upper($string));
    }
}

if(!function_exists('contul_picker'))
{
    /**
     * Convert empty string to null (datepicker)
     *
     * @param [type] $string
     * @return void
     */
    function contul_picker($string)
    {
        return ($string == '' || $string == "''" || empty($string) || $string == null) ? null : \Carbon\Carbon::createFromFormat('d-m-Y', $string)->format('Y-m-d');
    }
}

if(!function_exists('contul_textarea'))
{
    /**
     * Convert empty string to null (textarea)
     *
     * @param [type] $string
     * @return void
     */
    function contul_textarea($string)
    {
        return ($string == '' || $string == "''" || empty($string) || $string == null) ? null : \Str::upper($string);
    }
}

if(!function_exists('cek_otentikasi_halaman'))
{
    /**
     * Mengecek apakah si User berhak mengakses halaman formulir tersebut
     *
     * @param [type] $aktif
     * @param [type] $route
     * @return void
     */
    function cek_otentikasi_halaman($aktif, $route)
    {
        // if($route == \Route::currentRouteName() && $aktif == true){
        //     //true
        // }else if($route != \Route::currentRouteName() && $aktif == true){
        //     //true
        // }else if($route == \Route::currentRouteName() && $aktif == false){
        //     abort(404);
        // }else if($route != \Route::currentRouteName() && $aktif == false){
        //     //true
        // }


        if ( $aktif == false && $route == \Route::currentRouteName()) {
            abort(404); /**lempar ke not found */
        }

    }
}


if(!function_exists('cari_wilayah_wni'))
{
    function cari_wilayah_wni($id_provinsi, $id_kabupaten, $id_kecamatan, $id_kelurahan)
    {
        \DB::enablequerylog();

        if(empty($id_provinsi) or empty($id_kabupaten) or empty($id_kecamatan) or empty($id_kelurahan))
        {
            echo '<div class="alert alert-danger">parameter tidak cocok !, lengkapi : id_provinsi, id_kabupaten, id_kecamatan, dan id_kelurahan !</div>';
        }else{

            $search = \DB::table('m_setup_kel')
            ->select('m_setup_prop.nm_prop','m_setup_kab.nm_kab','m_setup_kec.nm_kec','m_setup_kel.nm_kel')
            ->join('m_setup_prop', function ($join){
                $join->on('m_setup_kel.id_m_setup_prop', '=', 'm_setup_prop.id_m_setup_prop');
            })
            ->join('m_setup_kab', function ($join){
                $join->on('m_setup_kel.id_m_setup_kab', '=', 'm_setup_kab.id_m_setup_kab')
                     ->on('m_setup_kab.id_m_setup_prop', '=', 'm_setup_prop.id_m_setup_prop');
            })
            ->join('m_setup_kec', function ($join){
                $join->on('m_setup_kel.id_m_setup_kec', '=', 'm_setup_kec.id_m_setup_kec')
                     ->on('m_setup_kec.id_m_setup_kab', '=', 'm_setup_kab.id_m_setup_kab')
                     ->on('m_setup_kec.id_m_setup_prop', '=', 'm_setup_prop.id_m_setup_prop');
            })
            ->where('m_setup_kel.id_m_setup_kel', $id_kelurahan)
            ->where('m_setup_kel.id_m_setup_kec', $id_kecamatan)
            ->where('m_setup_kel.id_m_setup_kab', $id_kabupaten)
            ->where('m_setup_kel.id_m_setup_prop', $id_provinsi)
            ->first();

            if($search){
                return [
                    "provinsi"  => $search->nm_prop ?? '-',
                    "kabupaten" => $search->nm_kab ?? '-',
                    "kecamatan" => $search->nm_kec ?? '-',
                    "kelurahan" => $search->nm_kel ?? '-',
                ];
            }else{
                echo '<div class="alert alert-danger">wilayah tidak ditemukan !</div>';
            }
            // $cari = cari_wilayah_wni(35,78,15,2000);
            // $kab = $cari['kabupaten'];
        }


    }
}



if (!function_exists('tanggal_indo')) {
    /**
     * fungsi merubah YYYY-MM-DD ke DD String Bulan Indo YYYY
     *
     * @param [type] $string
     * @return void
     */
    function tanggal_indo($date)
    {
        $arr_bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $retval = date('d', strtotime($date)) . ' ' . $arr_bulan[(int) date('m', strtotime($date))] . ' ' . date('Y', strtotime($date));
        return $retval;

    }
}

if (!function_exists('tanggal_hari')) {
    /**
     * fungsi merubah YYYY-MM-DD ke DD String Bulan Indo YYYY beserta hari nya
     *
     * @param [type] $string
     * @return void
     */
    function tanggal_hari($format,$nilai="now"){
        $en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb",
        "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
        $id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
        "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September",
        "Oktober","November","Desember");
        return str_replace($en,$id,date($format,strtotime($nilai)));
    }
}



if (!function_exists('upload_file')) {
    function upload_file(\Illuminate\Http\Request $request = null, $filenya, $filename, $folder, $extension=null)
    {
        $file = $request->file($filenya);
        if($file){
            // dd($extension);
            // $extension = $request->file($filenya)->extension();
            // Storage::deleteDirectory('public/'.$folder);

            if ($request->has($filenya)) {
                $path = Storage::disk('public')->putFileAs($folder, $file, $filename);
            }

            /*Pesan Error Validasi*/
            $messages = [
                $filenya.".required"  => "Silahkan memilih File / Dokumen terlebih dahulu !",
                $filenya.".mimes"     => "Ekstensi file tidak didukung atau tidak sesuai dengan ketentuan !",
            ];

            /*Proses Validasi Input*/
            $validator = \Validator::make($request->all(), [
                $filenya => ["required",'mimes:$extension'],
            ], $messages);

            /*Jika Validasi Gagal*/
            if ($validator->fails()) {
                $errors = $validator->errors();
                return \Response::json([
                    "error" => [
                        $filenya    => $errors->first($filenya),
                    ]
                ]);
            }
            return;
        }else{
            return;
        }

    }
}

if (!function_exists('ambil_umur')) {
    /**
     * fungsi mencari selisih dob (YYYY-MM-DD) ke format yg ditentukan
     *
     * @param [type] $string
     * @return void
     */
    function ambil_umur($format, $tgl)
    {
        $retval = \Carbon\Carbon::parse($tgl)->diff(\Carbon\Carbon::now())->format('%'.$format.'%');
        return $retval;
    }
}
