<?php


function create_random()
{
    $data = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTU1234567890';
    $srt = '';
    for($i = 0; $i < 15; $i++) {
        $pos = rand(0, strlen($data)-1);
        $srt .= $data[$pos];
    }
    return $srt;
}

function tgl_indo($tgl){
    return substr($tgl, 8, 2).' '.getbln(substr($tgl, 5,2)).' '.substr($tgl, 0, 4);
}


function tgl_now() {
    date_default_timezone_set('Asia/Makassar');
    return date('Y-m-d');
}

function time_now() {
    date_default_timezone_set('Asia/Makassar');
    return date('H:i:s');
}

function tglTime_now() {
    date_default_timezone_set('Asia/Makassar');
    return date('Y-m-d H:i:s');
}

function durasi_menit($awal, $akhir) {
    date_default_timezone_set('Asia/Makassar');
    
    $waktu_awal        =strtotime($awal);
    $waktu_akhir    =strtotime($akhir); // bisa juga waktu sekarang now()

    //menghitung selisih dengan hasil detik
    $diff    = $waktu_akhir - $waktu_awal;
    $menit   = ceil($diff / (60));

    return $menit;
}

function rupiah($nilai, $pecahan = 0) {
    return number_format($nilai, $pecahan, ',', '.');
}


function pengaturan() {
    $CI = &get_instance();
    $instansi = $CI->db->query("SELECT * FROM pengaturan WHERE id_pengaturan = '1'")->row_array();
    return $instansi;
}

function pesan($id) {
    $CI = &get_instance();
    $pesan = $CI->db->query("SELECT * FROM pesan WHERE id_pesan='$id'")->row_array();
    return $pesan['isi_pesan'];
}

function penerima($noWA){
    $wa = trim($noWA);
    $wa = str_replace(' ','',$wa);
    $wa = str_replace('-','',$wa);
    $belakang = substr($wa,1);
    $awal = substr($wa,0,1);

    if($awal == '0'){
      $nowa = '62'.$belakang;
    }else{
      $nowa = $wa;
    }
}


function danaMasuk($idJenisPenerimaan) {
    $CI = &get_instance();
    $saldo = $CI->db->query("SELECT id_jenis_penerimaan as id, jenis_dana, 
            (SELECT SUM(jumlah_dana) FROM penerimaan_detail WHERE id_jenis_penerimaan=id) as jum 
            FROM jenis_penerimaan WHERE id_jenis_penerimaan='$idJenisPenerimaan'")->row_array();
    $Pemasukan = $saldo['jum'];
    return $Pemasukan;
}


function danaKeluar($idJenisPengeluaran) {
    $CI = &get_instance();
    $saldo = $CI->db->query("SELECT id_jenis_penerimaan as id, jenis_dana, 
            (SELECT SUM(jumlah_dana) FROM penerimaan_detail WHERE id_jenis_penerimaan=id) as jum 
            FROM jenis_penerimaan WHERE id_jenis_penerimaan='$idJenisPenerimaan'")->row_array();
    $Pemasukan = $saldo['jum'];
    return $Pemasukan;
}



function aktifitas($aktifitas="") {
    $CI = &get_instance();
    $id = $CI->encryption->decrypt($CI->session->userdata('id'));
    $waktu = date('Y-m-d H:i:s');
    $aktv = $CI->db->query("INSERT INTO aktifitas SET 
        id_user = '$id', 
        aktifitas = '$aktifitas', 
        waktu = '$waktu', 
        detail = ''");
    return $aktv;
}








function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu ", "dua ", "tiga ", "empat ", "lima ", "enam ", "tujuh ", "delapan ", "sembilan ", "sepuluh ", "sebelas ");
    $temp = "";
    if ($nilai < 12) {
        $temp = "". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). "belas ";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)."puluh ". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = "seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . "ratus " . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = "seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . "ribu " . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . "juta " . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . "milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . "trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}

function check_login()
{
    $CI = &get_instance();
    if ($CI->session->userdata('username') == '') {
        redirect('');
    }
}

function getUser()
{
    $CI = &get_instance();
    $idUser = $CI->encryption->decrypt($CI->session->userdata('id'));
    $dataUser = $CI->db->query("
            SELECT * FROM users a 
            LEFT JOIN registrasi b ON a.id_join=b.id_reg 
            LEFT JOIN teknisi c ON b.id_reg=c.id_reg WHERE a.id='$idUser'
            ")->row_array();

    return $dataUser;
}

function infoUser($kolom = "")
{
    $CI = &get_instance();
    $idUser = $CI->encryption->decrypt($CI->session->userdata('id'));

    if($CI->encryption->decrypt($CI->session->userdata('role')) == 'Admin'){
        $dataUser = $CI->db->query("
            SELECT $kolom as dataKolom FROM users a WHERE a.id='$idUser'
            ")->row_array();
    }else{
        $dataUser = $CI->db->query("
            SELECT $kolom as dataKolom FROM instansi a WHERE a.id_instansi='$idUser'
            ")->row_array();
        // echo $CI->encryption->decrypt($CI->session->userdata('role');

    }
    
    return $dataUser['dataKolom'];
}


function selamat(){
    date_default_timezone_set("Asia/makassar");
    $jam = date("H:i:s");
    if($jam <='05:00:00'){
        echo "Selamat dini hari";
    }elseif($jam >='05:00:01' AND $jam <='11:00:00'){
        echo "Selamat Pagi";
    }elseif($jam >='11:00:01' AND $jam <='15:00:00'){
        echo "Selamat Siang";
    }elseif($jam >='15:00:01' AND $jam <='18:00:00'){
        echo "Selamat Sore";
    }elseif($jam >='18:00:01'){
        echo "Selamat Malam";
    }else{
        
    }
}





function poterlambat($jamawal, $jamakhir){
    $awal  = strtotime($jamawal);
    $akhir = strtotime($jamakhir);
    $diff  = $akhir - $awal;
    $menit = floor($diff / 60);
    $pot=0;

    if($menit > 120){
        $pot = 5;  
    }elseif($menit > 60){
        $pot = 2.5;
    }elseif($menit > 30){
        $pot = 1;
    }elseif($menit >= 1){
        $pot = 0.5;
    }
    return $pot;
}


function terlambatMenit($jamawal, $jamakhir){
    $awal  = strtotime($jamawal);
    $akhir = strtotime($jamakhir);
    $diff  = $akhir - $awal;
    $menit = floor($diff / 60);

    if($menit < 1){
        $menit = 0;
    }
    
    return $menit;
}


function JamKerja($hari){
    $this->CI =& get_instance();
    $r = $this->CI->db->query("SELECT * FROM jam_kerja WHERE HARI='$hari'")->row_array();
    $batasjam = $r['JAMPULANG'];
    return $batasjam;
}

function ijin($nip,$tanggal){
    $CI =& get_instance();
    $r = $CI->db->query("SELECT * FROM ijin_pegawai WHERE NIP='$nip' AND TANGGAL='$tanggal'")->row_array();
    return $r;
}


function namaHari($tanggal){
    $day=date("D", strtotime ($tanggal)); 
        if($day=='Mon'){
            $day='Senin';
        }else if($day=='Tue'){
            $day='Selasa';
        }else if($day=='Wed'){
            $day='Rabu';
        }else if($day=='Thu'){
            $day='Kamis';
        }else if($day=='Fri'){
            $day='Jumat';
        }else if($day=='Sat'){
            $day='Sabtu';
        }else if($day=='Sun'){
            $day='Minggu';
        }
    return $day;
}

function namaHariKecil($tanggal){
    $day=date("D", strtotime ($tanggal)); 
        if($day=='Mon'){
            $day='senin';
        }else if($day=='Tue'){
            $day='selasa';
        }else if($day=='Wed'){
            $day='rabu';
        }else if($day=='Thu'){
            $day='kamis';
        }else if($day=='Fri'){
            $day='jumat';
        }else if($day=='Sat'){
            $day='sabtu';
        }else if($day=='Sun'){
            $day='minggu';
        }
    return $day;
}


function conHari($tanggal){
$day=date("D", strtotime ($tanggal)); 
    if($day=='Mon'){
        $day='senin';
    }else if($day=='Tue'){
        $day='selasa';
    }else if($day=='Wed'){
        $day='rabu';
    }else if($day=='Thu'){
        $day='kamis';
    }else if($day=='Fri'){
        $day='jumat';
    }else if($day=='Sat'){
        $day='sabtu';
    }else if($day=='Sun'){
        $day='minggu';
    }
return $day;
}


function getbln($bln){
    switch ($bln) 
    {
        
        case 1:
            return "Januari";
        break;

        case 2:
            return "Februari";
        break;

        case 3:
            return "Maret";
        break;

        case 4:
            return "April";
        break;

        case 5:
            return "Mei";
        break;

        case 6:
            return "Juni";
        break;

        case 7:
            return "Juli";
        break;

        case 8:
            return "Agustus";
        break;

        case 9:
            return "September";
        break;

         case 10:
            return "Oktober";
        break;

        case 11:
            return "November";
        break;

        case 12:
            return "Desember";
        break;
    }

}

function getAbsenPegawai($nip='',$tanggal=''){

    $CI =& get_instance();  
    $a = $CI->db->query("SELECT a.userid, a.checktime, a.SN, b.badgenumber, c.kolok, c.nip, d.NAMA,'hadir' as status, e.tgl_1, 
f.senin_m, IF(time(MIN(a.checktime))> '12:00:00','TA',time(MIN(a.checktime))) as JamMasuk, TIMEDIFF(time(MIN(a.checktime)),f.senin_m) as selisihMasuk, 

f.senin_p, IF(time(MAX(a.checktime)) < '12:00:00' ,'TA',time(MAX(a.checktime))) as JamPulang, TIMEDIFF(f.senin_p,time(MAX(a.checktime))) as selisihPulang 

FROM 
            (SELECT userid, checktime, SN, '0' as jenis FROM checkinout where checktime like '2019-06-27%' UNION all SELECT userid, checktime, SN, '1' as jenis FROM checkinout_manual_2019 where checktime like '2019-06-27%') a 
            LEFT JOIN userinfo b ON a.userid=b.userid 
            LEFT JOIN mapping_id c ON a.SN=c.serial_number AND b.badgenumber=c.id_absen 
            LEFT JOIN pegawai d ON c.nip=d.NIP 
            LEFT JOIN jam_kerja_07 e ON d.NIP=e.nip 
            LEFT JOIN jam_kerja f ON e.tgl_1=f.id_jamker
            WHERE d.NIP='$nip' ");

    $output = $a->result();
    echo json_encode($output);
    // return

}



function blnAngka($hari){
                if($hari == "Juli"){
                    $hari = "7";
                        return $hari;
                }elseif($hari == "Agustus"){
                    $hari = "8";
                        return $hari;
                }elseif($hari == "September"){
                    $hari = "9";
                        return $hari;
                }elseif($hari == "Oktober"){
                    $hari = "10";
                        return $hari;
                }elseif($hari == "November"){
                    $hari = "11";
                        return $hari;
                }elseif($hari == "Desember"){
                    $hari = "12";
                        return $hari;
                }elseif($hari == "Januari"){
                    $hari = "1";
                        return $hari;
                }elseif($hari == "Februari"){
                    $hari = "2";
                        return $hari;
                }elseif($hari == "Maret"){
                    $hari = "3";
                        return $hari;
                }elseif($hari == "April"){
                    $hari = "4";
                        return $hari;
                }elseif($hari == "Mei"){
                    $hari = "5";
                        return $hari;
                }elseif($hari == "Juni"){
                    $hari = "6";
                        return $hari;
                }
            } 


