<?php
require_once 'DB.php';
class Siswa extends Test
{
    public function show(){
        $data = $this->Test->prepare("SELECT * FROM siswa");
        try {
            $data->execute(); //mengeksekusi query
            $result = $data->fetchAll (); //menampung hasil query
        } catch (PDOException $e) {
            print_r($e->getMessage()); //menampilkan error
        }
        return $result;
    }
    public function showPembayaran(){
        $data = $this->Test->prepare("SELECT * FROM pembayaran");
        try {
            $data->execute(); //mengeksekusi query
            $result = $data->fetchAll (); //menampung hasil query
        } catch (PDOException $e) {
            print_r($e->getMessage()); //menampilkan error
        }
        return $result;
    }

    public function showbyid($noinduk_siswa){
        $data = $this->Test->prepare("SELECT * FROM siswa WHERE noinduk_siswa=?) VALUES (?)");
        // $data->bindParam(1, $noinduk_siswa);
        try {
            $data->execute(array($data->bindParam(1, $noinduk_siswa)));
            $result = $data->fetch();
            $noinduk_siswa = $result['noinduk_siswa'];
            $noinduk_siswa = $result['nama_siswa'];
            $noinduk_siswa = $result['jenis_kelamin'];
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    public function store($noinduk_siswa, $nama_siswa, $jenis_kelamin, $tglLahir, $alamat, $anakke, $tgl_masuk, $tgl_lulus){
        
        $data = $this->Test->prepare("INSERT INTO siswa (noinduk_siswa, nama_siswa, jenis_kelamin, tglLahir, alamat, anakke, tgl_masuk, tgl_lulus)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $data->bindParam(1, $noinduk_siswa);
        $data->bindParam(2, $nama_siswa);
        $data->bindParam(3, $jenis_kelamin);
        $data->bindParam(4, $tglLahir);
        $data->bindParam(5, $alamat);
        $data->bindParam(6, $anakke);
        $data->bindParam(7, $tgl_masuk);
        $data->bindParam(8, $tgl_lulus);

       try {
            $data->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
    public function storePembayaran($noBayar, $tgl_bayar, $jumlah_bayar){
        
        $data = $this->Test->prepare("INSERT INTO pembayaran (noBayar, tgl_bayar, jumlah_bayar)
        VALUES(?, ?, ?)");
        $data->bindParam(1, $noBayar);
        $data->bindParam(2, $tgl_bayar);
        $data->bindParam(3, $jumlah_bayar);

       try {
            $data->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
    
    public function update($nama_siswa, $jenis_kelamin, $tglLahir, $alamat, $anakke, $tgl_masuk, $tgl_lulus, $noinduk_siswa){
        $data = $this->Test->prepare("UPDATE siswa SET nama_siswa=?, jenis_kelamin=?, tglLahir=?, alamat=?, anakke=?, tgl_masuk=?, tgl_lulus=? WHERE noinduk_siswa=?" );

        // $data->bindParam(8, $noinduk_siswa);
        // $data->bindParam(1, $nama_siswa);
        // $data->bindParam(2, $jenis_kelamin);
        // $data->bindParam(3, $tglLahir);
        // $data->bindParam(4, $alamat);
        // $data->bindParam(5, $anakke);
        // $data->bindParam(6, $tgl_masuk);
        // $data->bindParam(7, $tgl_lulus);

        try {
            $data->execute([$nama_siswa, $jenis_kelamin, $tglLahir, $alamat, $anakke, $tgl_masuk, $tgl_lulus, $noinduk_siswa]);
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
    public function updatePembayaran($tgl_bayar, $jumlah_bayar, $noBayar){
        $data = $this->Test->prepare("UPDATE pembayaran SET tgl_bayar=?, jumlah_bayar=? WHERE noBayar=?" );

        // $data->bindParam(8, $noinduk_siswa);
        // $data->bindParam(1, $nama_siswa);
        // $data->bindParam(2, $jenis_kelamin);
        // $data->bindParam(3, $tglLahir);
        // $data->bindParam(4, $alamat);
        // $data->bindParam(5, $anakke);
        // $data->bindParam(6, $tgl_masuk);
        // $data->bindParam(7, $tgl_lulus);

        try {
            $data->execute([$tgl_bayar, $jumlah_bayar, $noBayar]);
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
    public function delete($noinduk_siswa){
        $data = $this->Test->prepare("DELETE FROM siswa WHERE noinduk_siswa=?" );

        // $data->bindParam(8, $noinduk_siswa);
        // $data->bindParam(1, $nama_siswa);
        // $data->bindParam(2, $jenis_kelamin);
        // $data->bindParam(3, $tglLahir);
        // $data->bindParam(4, $alamat);
        // $data->bindParam(5, $anakke);
        // $data->bindParam(6, $tgl_masuk);
        // $data->bindParam(7, $tgl_lulus);

        try {
            $data->execute([$noinduk_siswa]);
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
}

?>