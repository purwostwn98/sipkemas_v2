<?php

namespace App\Controllers;

use App\Models\AjuanModel;
use App\Models\PemohonModel;
use App\Models\UploadModel;
use App\Models\KelurahanModel;
use App\Models\MitraModel;
use App\Models\KecamatanModel;
use App\Models\BantuanModel;
use CodeIgniter\I18n\Time;
use Mpdf\Mpdf;

class Dinsos extends BaseController
{
    protected $ajuanModel;
    protected $pemohonModel;
    protected $uploadModel;
    protected $kelurahanModel;
    protected $mitraModel;
    protected $kecamatanModel;
    protected $bantuanModel;
    public function __construct()
    {
        $this->session = session();
        $this->ajuanModel = new AjuanModel();
        $this->pemohonModel = new PemohonModel();
        $this->uploadModel = new UploadModel();
        $this->kelurahanModel = new KelurahanModel();
        $this->mitraModel = new MitraModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->bantuanModel = new BantuanModel();
    }


    //cek privilege sbg petugas dinsos
    public function cek()
    {
        if ($this->session->get('privUser') <> '3') {
            $this->session->destroy();
            return redirect()->to('/home/index');
            exit;
        }
    }

    public function dftrajuan_i()
    {
        $this->cek();
        $data = [
            'bttn' => 'sos_dftrajuan',
            'ajuan_baru' => $this->ajuanModel
                ->where('trajuan.idStsAjuan', 2)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_proses' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 3)
                ->where('trajuan.idStsAjuan <=', 5)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_selesai' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 6)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
        ];
        return view('dinsos/sos_dftrajuan_i', $data);
    }

    public function detailajuan_i($noAjuan)
    {
        $this->cek();
        $ajuan = $this->ajuanModel->where('noAjuan', $noAjuan)
            ->join('estatusajuan as sts', 'sts.idStsAjuan = trajuan.idStsAjuan')
            ->first();
        $data = [
            'bttn' => 'sos_dftrajuan',
            'ajuan' => $this->ajuanModel->where('noAjuan', $noAjuan)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('estatusajuan as sts', 'sts.idStsAjuan = trajuan.idStsAjuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->first(),
            'idStsAjuan' => $ajuan['idStsAjuan'],
            'StatusAjuan' => $ajuan['StatusAjuan'],
            'pemohon' => $this->pemohonModel->where('NIK', $ajuan['idPemohon'])
                ->join('eagama', 'eagama.idAgama = mpemohon.idAgama')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->join('ekecamatan', 'ekecamatan.idKec = ekelurahan.idKec')
                ->first(),
            'dokumen' => $this->uploadModel->where('noAjuan', $ajuan['noAjuan'])
                ->join('trsyarat', 'trsyarat.idSyarat = trupload.idSyarat')
                ->findAll(),
            'riwayat' => $this->ajuanModel->where('idPemohon', $ajuan['idPemohon'])
                ->where('noAjuan !=', $noAjuan)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('estatusajuan as sts', 'sts.idStsAjuan = trajuan.idStsAjuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')->findAll()
        ];
        return view('dinsos/sos_detailajuan_i', $data);
    }

    public function updateAjuan()
    {
        $this->cek();
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'eSik' => [
                    'label' => 'E-SIK',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
                'rekomendasi' => [
                    'label' => 'rekomendasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Anda harus memilih salah satu {field}'
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'eSik' => $validation->getError('eSik'),
                        'rec' => $validation->getError('rekomendasi'),
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $data = [
                    'eSik' => $this->request->getVar('eSik'),
                    'idRecDinsos' => $this->request->getVar('rekomendasi'),
                    'ketRecDinsos' => $this->request->getVar('ketRecDinsos'),
                    //'tgRecDinsos' => date('Y-m-d'),
                    'tgRecDinsos' => new Time('now', 'Asia/Jakarta', 'en_US'),
                    'idStsAjuan' => 3
                ];
                $save = $this->ajuanModel->where('idAjuan', $this->request->getVar('idAjuan'))->set($data)->update();
                if ($save) {
                    $msg = [
                        'berhasil' => [
                            'pesan' => "Rekomendasi berhasil dikirim",
                            'link' => "/dinsos/dftrajuan_i"
                        ]
                    ];
                } else {
                    $msg = [
                        'error' => [
                            'rec' => "Gagal simpan",
                            'token' => csrf_hash(),
                        ]
                    ];
                }
            }

            echo json_encode($msg);
        }
    }

    public function dashboard()
    {
        // Print tgl Indonesia
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        if ($this->request->getPost('filterTgl') == 'filter') {
            $filter = 'filter';
            $tgAwal = $this->request->getPost('tgAwal');
            $tgAhir = $this->request->getPost('tgAkhir');
            $tgl = explode('-', $tgAwal);
            $tgl2 = explode('-', $tgAhir);
            $tglAwal = $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0];
            $tglAkhir = $tgl2[2] . ' ' . $bulan[(int)$tgl2[1]] . ' ' . $tgl2[0];
        } elseif ($this->request->getGet('hpsFilter') == 'noFilter') {
            $filter = 'noFilter';
            //$tgAwal = Time::parse('March 9, 2016 12:00:00', 'Asia/Jakarta');
            $tgAwal = 0000 - 00 - 00;
            $tgAhir = new Time('now', 'Asia/Jakarta', 'en_US');
            $tglAwal = "Semua Data";
            $tglAkhir = "";
        } else {
            $filter = 'noFilter';
            //$tgAwal = Time::parse('March 9, 2016 12:00:00', 'Asia/Jakarta');
            $tgAwal = 0000 - 00 - 00;
            $tgAhir = new Time('now', 'Asia/Jakarta', 'en_US');
            $tglAwal = "Semua Data";
            $tglAkhir = "";
        }

        //Untuk statistik kelurahan
        $dftrKelurahan = $this->kelurahanModel->findAll();
        foreach ($dftrKelurahan as $kel) {
            $countAjuanKelurahan = $this->ajuanModel
                ->where('idStsAjuan >', 2)
                ->where('idJnsAjuan', 0) //Ajuan Individu
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $kel['idKel'])
                ->countAllResults();
            $semuaKelurahan[$kel['Kelurahan']] = $countAjuanKelurahan;
            // arsort($semuaKelurahan);
        }
        // Untuk statistik mitra
        $dftrMitra = $this->mitraModel->findAll();
        foreach ($dftrMitra as $mit) {
            $countAjuanMitra = $this->ajuanModel
                ->where('idStsAjuan >', 2)
                ->where('idJnsAjuan', 0)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $mit['idMitra'])
                ->countAllResults();
            $semuaMitra[] = $countAjuanMitra;
        }
        //Untuk statistik kecamatan
        $dftrKecamatan = $this->kecamatanModel->findAll();
        foreach ($dftrKecamatan as $kec) {
            $countAjuanKecamatan = $this->ajuanModel
                ->where('idStsAjuan >', 2)
                ->where('idJnsAjuan', 0)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->where('idKec', $kec['idKec'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $semuaKecamatan[$kec['Kecamatan']] = $countAjuanKecamatan;
            //arsort($semuaKelurahan);
        }
        // Untuk statistik bantuan
        $dftrBantuan = $this->bantuanModel->findAll();
        foreach ($dftrBantuan as $ban) {
            $countAjuanBantuan = $this->ajuanModel
                ->where('idStsAjuan >', 2)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idJnsAjuan', 0)
                ->where('trajuan.kodeBantuan', $ban['kodeBantuan'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $semuaBantuan[] = $countAjuanBantuan;
        }
        $data = [
            'countPermintaan' => $this->ajuanModel
                ->where('idStsAjuan', 2)
                ->where('idJnsAjuan', 0)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countProses' => $this->ajuanModel
                ->where('idStsAjuan >', 2)
                ->where('idStsAjuan <', 6)
                ->where('idJnsAjuan', 0)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDitolak' => $this->ajuanModel
                ->where('idStsAjuan', 6)
                ->where('idJnsAjuan', 0)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDisetujui' => $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('idJnsAjuan', 0)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'totalDana' => $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->where('idJnsAjuan', 0)
                ->first(),
            'countKelurahan' => $semuaKelurahan,
            'countMitra' => $semuaMitra,
            'countKecamatan' => $semuaKecamatan,
            'countBantuan' => $semuaBantuan,
            'daftarBantuan' => $dftrBantuan,
            'daftarMitra' => $dftrMitra,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'norm_tglAwal' => $tgAwal,
            'norm_tglAkhir' => $tgAhir,
            'filter' => $filter,
            'bttn' => 'dashboard_dinsos',
            'halaman' => 'dinsos'
        ];
        return view('kesra/dashboard', $data);
    }

    public function eksporpdf()
    {
        //Print tgl Indonesia
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        if ($this->request->getVar('filter') == 'filter') {
            $tgAwal = $this->request->getVar('tgAwal');
            $tgAhir = $this->request->getVar('tgAkhir');
            $tgl = explode('-', $tgAwal);
            $tgl2 = explode('-', $tgAhir);
            $tglAwal = $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0];
            $tglAkhir = $tgl2[2] . ' ' . $bulan[(int)$tgl2[1]] . ' ' . $tgl2[0];
        } else {
            //$tgAwal = Time::parse('March 9, 2016 12:00:00', 'Asia/Jakarta');
            $tgAwal = 0000 - 00 - 00;
            $tgAhir = new Time('now', 'Asia/Jakarta', 'en_US');
            $tglAwal = "Semua Data";
            $tglAkhir = "";
        }

        //Untuk statistik kelurahan
        $dftrKelurahan = $this->kelurahanModel->findAll();
        foreach ($dftrKelurahan as $kel) {
            $countAjuanKelurahan = $this->ajuanModel
                ->where('idStsAjuan >', 2)
                ->where('idJnsAjuan', 0) //Ajuan Individu
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $kel['idKel'])
                ->countAllResults();
            $countKelurahanSetuju = $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('idJnsAjuan', 0)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $kel['idKel'])
                ->countAllResults();
            $danaKel = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $kel['idKel'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->first();
            $semuaKelurahan[$kel['Kelurahan']] = array($countAjuanKelurahan, $countKelurahanSetuju, $danaKel['nilaiDisetujui']);
            arsort($semuaKelurahan);
        }
        //Untuk statistik kecamatan
        $dftrKecamatan = $this->kecamatanModel->findAll();
        foreach ($dftrKecamatan as $kec) {
            $countAjuanKecamatan = $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->where('idKec', $kec['idKec'])
                ->countAllResults();
            $countDisetujuiKec = $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->where('idKec', $kec['idKec'])
                ->countAllResults();
            $danaKec = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->where('idKec', $kec['idKec'])
                ->first();
            $semuaKecamatan[$kec['Kecamatan']] = array($countAjuanKecamatan, $countDisetujuiKec, $danaKec['nilaiDisetujui']);
            //arsort($semuaKelurahan);
        }
        // Untuk statistik mitra
        $dftrMitra = $this->mitraModel->findAll();
        foreach ($dftrMitra as $mit) {
            $countAjuanMitra = $this->ajuanModel
                ->where('idStsAjuan >', 2)
                ->where('idJnsAjuan', 0)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $mit['idMitra'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $semuaMitra[$mit['NamaMitra']] = $countAjuanMitra;
            $countMitraSetuju = $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('idJnsAjuan', 0)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $mit['idMitra'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $mitraSetuju[] = $countMitraSetuju;
            $dana = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idJnsAjuan', 0)
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->where('trbantuan.idMitra', $mit['idMitra'])
                ->first();
            $danaMtrSetuju[] = $dana['nilaiDisetujui'];
        }
        // Untuk statistik bantuan
        $dftrBantuan = $this->bantuanModel->findAll();
        foreach ($dftrBantuan as $ban) {
            $countAjuanBantuan = $this->ajuanModel
                ->where('idStsAjuan >', 2)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idJnsAjuan', 0)
                ->where('trajuan.kodeBantuan', $ban['kodeBantuan'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $danaBantuan = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idJnsAjuan', 0)
                ->where('trajuan.kodeBantuan', $ban['kodeBantuan'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->first();
            $semuaBantuan[$ban['namaProgram']] = array($countAjuanBantuan, $danaBantuan['nilaiDisetujui']);
            arsort($semuaBantuan);
        }
        $tglNow = new Time('now', 'Asia/Jakarta', 'en_US');
        $t = explode('-', $tglNow);
        $a = explode(' ', $t[2]);
        $tglSekarang = $a[0] . ' ' . $bulan[(int)$t[1]] . ' ' . $t[0];
        $data = [
            'countPermintaan' => $this->ajuanModel
                ->where('idStsAjuan', 2)
                ->where('idJnsAjuan', 0)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countProses' => $this->ajuanModel
                ->where('idStsAjuan >', 2)
                ->where('idStsAjuan <', 6)
                ->where('idJnsAjuan', 0)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDitolak' => $this->ajuanModel
                ->where('idStsAjuan', 6)
                ->where('idJnsAjuan', 0)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDisetujui' => $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('idJnsAjuan', 0)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'totalDana' => $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->where('idJnsAjuan', 0)
                ->first(),
            'countKelurahan' => $semuaKelurahan,
            'countKecamatan' => $semuaKecamatan,
            'countMitra' => $semuaMitra,
            'mitraSetuju' => $mitraSetuju,
            'danaMitraSetuju' => $danaMtrSetuju,
            'countBantuan' => $semuaBantuan,
            'daftarBantuan' => $dftrBantuan,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'tglNow' => $tglSekarang,
            'filter' => $this->request->getVar('filter'),
            'halaman' => 'dinsos'
        ];
        $mpdf = new Mpdf([
            'debug' => TRUE, 'mode' => 'utf-8', 'format' => 'A4-P',
            'margin_top' => 8, 'margin_bottom' => 10, 'margin_left' => 12, 'margin_right' => 12
        ]);
        // $mpdf = new \Mpdf\Mpdf([
        //     'debug' => FALSE, 'mode' => 'utf-8', 'orientation' => 'L', 'format' => [216, 308],
        //     'margin_top' => 15, 'margin_bottom' => 10, 'margin_left' => 12, 'margin_right' => 12
        // ]);
        $html = view('kesra/dashboard_pdf.php', $data);
        $mpdf->text_input_as_HTML = true;
        $mpdf->WriteHTML($html);
        //$this->response->setHeader('Content-Type', 'application/pdf');

        $mpdf->Output($tglAwal . ".pdf", 'D');
        //$mpdf->Output('judulfile.pdf', 'D');
    }
}
