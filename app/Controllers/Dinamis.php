<?php

namespace App\Controllers;

use App\Models\PemohonModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\FormulirModel;
use App\Models\AjuanModel;
use App\Models\BantuanModel;
use App\Models\MitraModel;
use App\Models\SyaratModel;
use CodeIgniter\I18n\Time;
use Mpdf\Mpdf;

class Dinamis extends BaseController
{
    protected $pemohonModel;
    protected $kecamatanModel;
    protected $kelurahanModel;
    protected $formulirModel;
    protected $ajuanModel;
    protected $mitraModel;
    protected $syaratModel;

    public function __construct()
    {
        $this->pemohonModel = new PemohonModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->kelurahanModel = new KelurahanModel();
        $this->formulirModel = new FormulirModel();
        $this->ajuanModel = new AjuanModel();
        $this->mitraModel = new MitraModel();
        $this->programModel = new BantuanModel();
        $this->syaratModel = new SyaratModel();
    }

    public function cek_biodata_nik()
    {
        if ($this->request->isAJAX()) {
            $a = random_int(1, 9);
            $b = random_int(1, 9);
            $operator = "x+";
            $opr = substr($operator, mt_rand(0, strlen($operator) - 1), 1);
            $angka = array(
                1 =>   'satu',
                'dua',
                'tiga',
                'empat',
                'lima',
                'enam',
                'tujuh',
                'delapan',
                'sembilan'
            );
            if ($opr == 'x') {
                $hasil = $a * $b;
                $text_opr = 'dikali';
            } elseif ($opr == '+') {
                $hasil = $a + $b;
                $text_opr = 'ditambah';
            }
            $text = 'Berapa ' . $angka[$a] . ' ' . $text_opr . ' ' . $angka[$b] . '?';
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nik' => [
                    'label' => 'NIK',
                    'rules' => 'required|exact_length[16]|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'exact_length' => '{field} harus 16 angka',
                        'numeric' => '{field} harus berupa angka'
                    ]
                ]
            ]);
            if (!$valid) {
                $data = [
                    'pesan' => $validation->getError('nik'),
                    'biodata' => 404,
                    'status' => 404
                ];
            } else {
                $nik = $this->request->getVar('nik');
                $biodata = $this->pemohonModel->where('NIK', $nik)
                    ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                    ->join('ekecamatan', 'ekecamatan.idKec = ekelurahan.idKec')
                    ->first();
                if ($biodata) {
                    $pesan = "Biodata Anda sudah tersimpan, silahkan klik daftar untuk melanjutkan ajuan!";
                    $biodata = $biodata;
                    $kecamatan = $this->kecamatanModel->findAll();
                    $kelurahan = $this->kelurahanModel->where('idKec', $biodata['idKec'])->findAll();
                    $status = 0;
                } else {
                    $pesan = "Mohon lengkapi biodata di bawah ini!";
                    $biodata = 1;
                    $kecamatan = $this->kecamatanModel->findAll();
                    $kelurahan = "";
                    $status = 1;
                }
                $data = [
                    'pesan' => $pesan,
                    'biodata' => $biodata,
                    'kecamatan' => $kecamatan,
                    'kelurahan' => $kelurahan,
                    'status' => $status,
                    'text' => $text,
                    'hasil' => $hasil
                ];
            }
            $msg = [
                'data' => view('landing/dinamis/form_biodata', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    // Load form syarat dinamis
    public function form_syarat()
    {
        if ($this->request->isAJAX()) {
            $kodeBantuan = $this->request->getVar('kodeBantuan');
            $data = [
                'Syarat' => $this->syaratModel->where('kodeBantuan', $kodeBantuan)
                    ->where('StatusSyarat', 'active')
                    ->findAll()
            ];
            $msg = [
                'data' => view('pemohon/formSyarat', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
