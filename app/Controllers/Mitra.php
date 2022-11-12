<?php

namespace App\Controllers;

use App\Models\AjuanModel;
use App\Models\PemohonModel;
use App\Models\UploadModel;
use App\Models\AjuanLbgModel;
use App\Models\KelurahanModel;
use App\Models\MitraModel;
use App\Models\BantuanModel;
use App\Models\KecamatanModel;
use App\Models\SyaratModel;
use CodeIgniter\I18n\Time;
use Mpdf\Mpdf as MpdfMpdf;

class Mitra extends BaseController
{
    protected $ajuanModel;
    protected $pemohonModel;
    protected $uploadModel;
    protected $ajuanLbgModel;
    protected $kelurahanModel;
    protected $mitraModel;
    protected $bantuanModel;
    protected $syaratModel;
    protected $kecamatanModel;
    public function __construct()
    {
        $this->ajuanModel = new AjuanModel();
        $this->pemohonModel = new PemohonModel();
        $this->uploadModel = new UploadModel();
        $this->ajuanLbgModel = new AjuanLbgModel();
        $this->kelurahanModel = new KelurahanModel();
        $this->mitraModel = new MitraModel();
        $this->bantuanModel = new BantuanModel();
        $this->syaratModel = new SyaratModel();
        $this->kecamatanModel = new KecamatanModel();
    }

    public function dashboard()
    {
        if ($this->session->get('privUser') != 5) {
            $idMitra = $this->request->getVar('idMitra');
        } else {
            $idMitra = $this->session->get('idLembaga');
        }
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
                ->where('idStsAjuan >', 1)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $kel['idKel'])
                ->countAllResults();
            $semuaKelurahan[$kel['Kelurahan']] = $countAjuanKelurahan;
            //arsort($semuaKelurahan);
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
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults();
            $semuaKecamatan[$kec['Kecamatan']] = $countAjuanKecamatan;
            //arsort($semuaKelurahan);
        }
        // Untuk statistik mitra
        $dftrMitra = $this->mitraModel->findAll();
        foreach ($dftrMitra as $mit) {
            $countAjuanMitra = $this->ajuanModel
                ->where('idStsAjuan >', 1)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $mit['idMitra'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $semuaMitra[] = $countAjuanMitra;
        }
        // Untuk statistik bantuan
        $dftrBantuan = $this->bantuanModel
            ->where('idMitra', $idMitra)
            ->findAll();
        if ($dftrBantuan) {
            foreach ($dftrBantuan as $ban) {
                $countAjuanBantuan = $this->ajuanModel
                    ->where('idStsAjuan >=', 2)
                    ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                    // ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                    ->where('trajuan.kodeBantuan', $ban['kodeBantuan'])
                    ->where('tgHasil >=', $tgAwal)
                    ->where('tgHasil <=', $tgAhir)
                    ->countAllResults();
                $semuaBantuan[] = $countAjuanBantuan;
            }
        } else {
            $semuaBantuan = [0, 0, 0, 0];
        }

        $data = [
            'countPermintaan' => $this->ajuanModel
                ->where('idStsAjuan', 4)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults(),
            'countProses' => $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->where('idStsAjuan <=', 3)
                // ->where('idStsAjuan !=', 6)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDitolak' => $this->ajuanModel
                ->where('idStsAjuan', 6)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDisetujui' => $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'totalDana' => $this->ajuanModel->selectSum('nilaiDisetujui')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->first(),
            'countKelurahan' => $semuaKelurahan,
            'countKecamatan' => $semuaKecamatan,
            'countMitra' => $semuaMitra,
            'countBantuan' => $semuaBantuan,
            'daftarBantuan' => $dftrBantuan,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'norm_tglAwal' => $tgAwal,
            'norm_tglAkhir' => $tgAhir,
            'filter' => $filter,
            'bttn' => 'dashboard_mitra',
            'halaman' => 'mitra'
        ];
        return view('kesra/dashboard', $data);
    }

    public function eksporpdf()
    {
        if ($this->session->get('privUser') != 5) {
            $idMitra = $this->request->getVar('idMitra');
        } else {
            $idMitra = $this->session->get('idLembaga');
        }
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
                ->where('idStsAjuan >', 1)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $kel['idKel'])
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults();
            $countKelurahanSetuju = $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $kel['idKel'])
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults();
            $danaKel = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
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
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults();
            $countDisetujuiKec = $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->where('idKec', $kec['idKec'])
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults();
            $danaKec = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->where('idKec', $kec['idKec'])
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->first();
            $semuaKecamatan[$kec['Kecamatan']] = array($countAjuanKecamatan, $countDisetujuiKec, $danaKec['nilaiDisetujui']);
            //arsort($semuaKelurahan);
        }
        // Untuk statistik bantuan
        $dftrBantuan = $this->bantuanModel
            ->where('idMitra', $idMitra)
            ->findAll();
        foreach ($dftrBantuan as $ban) {
            $countAjuanBantuan = $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('trajuan.kodeBantuan', $ban['kodeBantuan'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $danaBantuan = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
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
                ->where('idStsAjuan', 3)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults(),
            'countProses' => $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->where('idStsAjuan <', 6)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDitolak' => $this->ajuanModel
                ->where('idStsAjuan', 6)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->where('idMitra', $idMitra)
                ->countAllResults(),
            'countDisetujui' => $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->where('idMitra', $idMitra)
                ->countAllResults(),
            'totalDana' => $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->first(),
            'countKelurahan' => $semuaKelurahan,
            'countKecamatan' => $semuaKecamatan,
            // 'countMitra' => $semuaMitra,
            // 'mitraSetuju' => $mitraSetuju,
            // 'danaMitraSetuju' => $danaMtrSetuju,
            'countBantuan' => $semuaBantuan,
            'daftarBantuan' => $dftrBantuan,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'tglNow' => $tglSekarang,
            'filter' => $this->request->getVar('filter'),
            'halaman' => 'mitra',
            'mitra' => $this->mitraModel->find($idMitra)
        ];
        $mpdf = new MpdfMpdf([
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

    public function dftprogram()
    {
        $idMitra = $this->session->get('idLembaga');
        $db      = \Config\Database::connect();
        $program = $db->table('trbantuan')->getWhere(['idMitra' => $idMitra])->getResult();
        //$query = $data ;
        //print_r($program); exit;
        $data = [
            'bttn' => 'dftrbantuan',
            'program' => $program, //$this->bantuanModel
            //->where('trbantuan.idMitra', $idMitra)
            //->where('trajuan.idStsAjuan', 4)
            //->where('idJnsAjuan', 0)
            //->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
            //->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
            //->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
            //->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')

            //->findAll(),
            /*'ajuan_proses' => $this->ajuanModel
                ->where('trajuan.idStsAjuan', 5)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $idMitra)
                ->findAll(),
            'ajuan_selesai' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 6)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $idMitra)
                ->findAll()*/
        ];
        return view('mitra/dftprogram', $data);
    }

    public function dftrajuan_i()
    {
        $idMitra = $this->session->get('idLembaga');
        $data = [
            'bttn' => 'mit_dftrajuan',
            'ajuan_otw' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >', 1)
                ->where('trajuan.idStsAjuan <=', 3)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $idMitra)
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_baru' => $this->ajuanModel
                ->where('trajuan.idStsAjuan', 4)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $idMitra)
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_proses' => $this->ajuanModel
                ->where('trajuan.idStsAjuan', 5)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $idMitra)
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_selesai' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 6)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $idMitra)
                ->orderBy('tgHasil', 'DESC')
                ->findAll()
        ];
        //print_r($data);exit();
        return view('mitra/dftrajuan_i', $data);
    }

    public function dftrajuan_l()
    {
        $idMitra = $this->session->get('idLembaga');
        $data = [
            'bttn' => 'mit_dftrajuan',
            'ajuan_baru' => $this->ajuanModel
                ->where('trajuan.idStsAjuan', 4)
                ->where('idJnsAjuan', 1)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('trlembaga', 'trlembaga.noAjuan = trajuan.noAjuan')
                ->where('trbantuan.idMitra', $idMitra)
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_proses' => $this->ajuanModel
                ->where('trajuan.idStsAjuan', 5)
                ->where('idJnsAjuan', 1)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('trlembaga', 'trlembaga.noAjuan = trajuan.noAjuan')
                ->where('trbantuan.idMitra', $idMitra)
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_selesai' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 6)
                ->where('idJnsAjuan', 1)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('trlembaga', 'trlembaga.noAjuan = trajuan.noAjuan')
                ->where('trbantuan.idMitra', $idMitra)
                ->orderBy('tgHasil', 'DESC')
                ->findAll()
        ];
        return view('mitra/dftrajuan_l', $data);
    }

    public function detailajuan_i($noAjuan)
    {
        $ajuan = $this->ajuanModel->where('noAjuan', $noAjuan)
            ->join('estatusajuan as sts', 'sts.idStsAjuan = trajuan.idStsAjuan')
            ->first();
        $data = [
            'bttn' => 'mit_dftrajuan',
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
        return view('mitra/detailajuan_i', $data);
    }

    public function detailajuan_l($noAjuan)
    {
        $ajuan = $this->ajuanModel->where('noAjuan', $noAjuan)
            ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
            ->join('estatusajuan as sts', 'sts.idStsAjuan = trajuan.idStsAjuan')
            ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
            ->first();
        $data = [
            'bttn' => 'mit_dftrajuan',
            'ajuan' => $ajuan,
            'idStsAjuan' => $ajuan['idStsAjuan'],
            'StatusAjuan' => $ajuan['StatusAjuan'],
            'pemohon' => $this->pemohonModel->where('NIK', $ajuan['idPemohon'])
                ->join('eagama', 'eagama.idAgama = mpemohon.idAgama')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->join('ekecamatan', 'ekecamatan.idKec = ekelurahan.idKec')
                ->first(),
            'lembaga' => $this->ajuanLbgModel->where('noAjuan', $noAjuan)->first(),
            'dokumen' => $this->uploadModel->where('noAjuan', $ajuan['noAjuan'])
                ->join('trsyarat', 'trsyarat.idSyarat = trupload.idSyarat')
                ->findAll(),
            'riwayat' => $this->ajuanModel->where('idPemohon', $ajuan['idPemohon'])
                ->where('noAjuan !=', $noAjuan)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('estatusajuan as sts', 'sts.idStsAjuan = trajuan.idStsAjuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')->findAll()
        ];
        return view('mitra/detailajuan_l', $data);
    }

    public function doTindakan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'persetujuan' => [
                    'label' => 'persetujuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Anda harus memilih salah satu {field}'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'persetujuan' => $validation->getError('persetujuan'),
                        'token' => csrf_hash()
                    ]
                ];
            } else {
                // Jika disetujui maka nilai bantuan wajib
                if ($this->request->getVar('persetujuan') == 1) {
                    //validasi nilai bantuan
                    $valid2 = $this->validate([
                        'nilai' => [
                            'label' => 'Nilai bantuan',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} tidak boleh kosong'
                            ]
                        ],
                    ]);
                    if (!$valid2) {
                        $msg = [
                            'error' => [
                                'nilai' => $validation->getError('nilai'),
                                'token' => csrf_hash(),
                            ]
                        ];
                        echo json_encode($msg);
                        return FALSE;
                    }
                }
                if ($this->request->getVar('persetujuan') == 1) {
                    $idStsAjuan = 7;
                } elseif ($this->request->getVar('persetujuan') == 2) {
                    $idStsAjuan = 5;
                } elseif ($this->request->getVar('persetujuan') == 3) {
                    $idStsAjuan = 6;
                }
                // rubah format nilai
                $strNilaiDisetujui = $this->request->getVar('nilai');
                $numbNilaiDisetujui = str_replace(".", "", $strNilaiDisetujui);

                $data = [
                    'nilaiDisetujui' => $numbNilaiDisetujui,
                    'ketRecSurvey' => $this->request->getVar('alasan'),
                    'tgRecSurvey' => new Time('now', 'Asia/Jakarta', 'en_US'),
                    'idStsAjuan' => $idStsAjuan
                ];
                $save = $this->ajuanModel->where('idAjuan', $this->request->getVar('idAjuan'))->set($data)->update();
                if ($save) {
                    $msg = [
                        'berhasil' => [
                            'pesan' => "Hasil berhasil dikirim",
                            'link' => "/mitra/dftrajuan_i"
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

    function pemohonpdf($program)
    {
        $idMitra = $this->session->get('idLembaga');

        $bantuan = $this->bantuanModel->where('idBantuan', $program)
            ->where('idMitra', $idMitra)
            ->first();

        //print_r($bantuan);exit;
        $data = [
            'bttn' => '',
            'program' => $bantuan,
            'judul' => 'Daftar Pemohon Bantuan',
            'ajuan_all' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 4)
                ->where('trajuan.idStsAjuan <=', 7)
                //->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                //->join('trajuan', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $idMitra)
                ->findAll(),

        ];


        $mpdf = new \Mpdf\Mpdf([
            'debug' => FALSE, 'mode' => 'utf-8', 'orientation' => 'L', 'format' => [216, 308],
            'margin_top' =>     15, 'margin_bottom' => 10, 'margin_left' => 12, 'margin_right' => 12
        ]);
        $html = view('/mitra/pemohonpdf_v.php', $data);
        $mpdf->WriteHTML($html);
        //$this->response->setHeader('Content-Type', 'application/pdf');

        $mpdf->Output($bantuan['namaProgram'] . ".pdf", 'D');
    }

    public function detailProgram()
    {
        $idBantuan = $this->request->getVar('kode');
        $bantuan = $this->bantuanModel
            ->where('idBantuan', $idBantuan)
            ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
            ->first();
        $countSyarat = $this->syaratModel->where('kodeBantuan', $bantuan['kodeBantuan'])->countAllResults();
        if ($countSyarat >= 1) {
            $syaratProgram = $this->syaratModel->where('kodeBantuan', $bantuan['kodeBantuan'])->findAll();
        } else {
            $syaratProgram = 0;
        }
        $data = [
            'bttn' => 'mit_program',
            'bantuan' => $bantuan,
            'syaratProgram' => $syaratProgram
        ];
        return view('mitra/detailProgram', $data);
    }
}
