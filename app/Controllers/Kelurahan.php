<?php

namespace App\Controllers;

use App\Models\PemohonModel;
use App\Models\FormulirModel;
use App\Models\AjuanModel;
use App\Models\UploadModel;
use App\Models\AjuanLbgModel;
use CodeIgniter\I18n\Time;
use App\Models\KelurahanModel;
use App\Models\MitraModel;
use App\Models\BantuanModel;
use Mpdf\Mpdf;

class Kelurahan extends BaseController
{
    protected $pemohonModel;
    protected $formulirModel;
    protected $ajuanModel;
    protected $uploadModel;
    protected $ajuanLbgModel;
    protected $kelurahanModel;
    protected $mitraModel;
    protected $bantuanModel;




    public function __construct()
    {
        $this->session = session();

        $this->pemohonModel = new PemohonModel();
        $this->formulirModel = new FormulirModel();
        $this->ajuanModel = new AjuanModel();
        $this->uploadModel = new UploadModel();
        $this->ajuanLbgModel = new AjuanLbgModel();
        $this->kelurahanModel = new KelurahanModel();
        $this->mitraModel = new MitraModel();
        $this->bantuanModel = new BantuanModel();



        //print_r('x');exit;
        //return view('/kelurahan/kel_dftrpemohon_i');
        //$nama =$this->session->get('privUser');
        //if ($nama == '3'){print_r($nama); exit;}


    }

    //cek privilege sbg petugas kelurahan
    public function cek()
    {
        if ($this->session->get('privUser') <> '2') {
            $this->session->destroy();
            return redirect()->to('/home/index');
            exit;
        }
    }

    public function dashboard()
    {
        $idMitra = $this->session->get('idLembaga'); //idkelurahan
        // print_r($idMitra);
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


        // Untuk statistik mitra
        $dftrMitra = $this->mitraModel->findAll();
        foreach ($dftrMitra as $mit) {
            $countAjuanMitra = $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idMitra)
                ->where('trbantuan.idMitra', $mit['idMitra'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $semuaMitra[] = $countAjuanMitra;
        }

        // Untuk statistik bantuan
        $dftrBantuan = $this->bantuanModel->findAll();
        foreach ($dftrBantuan as $ban) {
            $countAjuanBantuan = $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idMitra)
                ->where('trajuan.kodeBantuan', $ban['kodeBantuan'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $semuaBantuan[] = $countAjuanBantuan;
        }
        //print_r($semuaMitra);exit();
        $data = [
            'countPermintaan' => $this->formulirModel
                ->where('tgInput >=', $tgAwal)
                ->where('tgInput <=', $tgAhir)
                ->where('idKel', $idMitra)
                ->countAllResults(),
            'countProses' => $this->ajuanModel
                ->where('idStsAjuan >=', 3)
                ->where('idStsAjuan <=', 5)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idMitra)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDitolak' => $this->ajuanModel
                ->where('idStsAjuan', 6)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idMitra)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDisetujui' => $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idMitra)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'totalDana' => $this->ajuanModel->selectSum('nilaiDisetujui')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idMitra)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->first(),
            //'countKelurahan' => $semuaKelurahan,
            'countMitra' => $semuaMitra,
            'countBantuan' => $semuaBantuan,
            'daftarMitra' => $dftrMitra,
            'daftarBantuan' => $dftrBantuan,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'norm_tglAwal' => $tgAwal,
            'norm_tglAkhir' => $tgAhir,
            'filter' => $filter,
            'bttn' => 'dashboard',
            'halaman' => 'kelurahan'
        ];
        return view('kelurahan/kel_dashboard', $data);
    }

    public function eksporpdf()
    {
        $idKelurahan = $this->session->get('idLembaga'); //idkelurahan
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

        // Untuk statistik mitra
        $dftrMitra = $this->mitraModel->findAll();
        foreach ($dftrMitra as $mit) {
            $countAjuanMitra = $this->ajuanModel
                ->where('idStsAjuan >', 1)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idKelurahan)
                ->where('trbantuan.idMitra', $mit['idMitra'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $semuaMitra[$mit['NamaMitra']] = $countAjuanMitra;
            $countMitraSetuju = $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idKelurahan)
                ->where('trbantuan.idMitra', $mit['idMitra'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $mitraSetuju[] = $countMitraSetuju;
            $dana = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idKelurahan)
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
                ->where('idStsAjuan >=', 2)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idKelurahan)
                ->where('trajuan.kodeBantuan', $ban['kodeBantuan'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $danaBantuan = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idKelurahan)
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
            'countPermintaan' => $this->formulirModel
                ->where('tgInput >=', $tgAwal)
                ->where('tgInput <=', $tgAhir)
                ->where('idKel', $idKelurahan)
                ->countAllResults(),
            'countProses' => $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->where('idStsAjuan <', 6)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idKelurahan)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDitolak' => $this->ajuanModel
                ->where('idStsAjuan', 6)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idKelurahan)
                ->countAllResults(),
            'countDisetujui' => $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idKelurahan)
                ->countAllResults(),
            'totalDana' => $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $idKelurahan)
                ->first(),
            // 'countKelurahan' => $semuaKelurahan,
            'countMitra' => $semuaMitra,
            'mitraSetuju' => $mitraSetuju,
            'danaMitraSetuju' => $danaMtrSetuju,
            'countBantuan' => $semuaBantuan,
            'daftarBantuan' => $dftrBantuan,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'tglNow' => $tglSekarang,
            'filter' => $this->request->getVar('filter'),
            'halaman' => 'kelurahan'
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

    public function dtpemohon()
    {
        $this->cek();
        $konfirmasi = $this->request->getVar('konfirmasi');
        if ($konfirmasi == 'cfcd208495d565ef66e7dff9f98764da') {
            $kode = 0;
            $noFormulir = $this->request->getVar('no');
            $pemohon = $this->formulirModel->where('noFormulir', $noFormulir)
                ->join('eagama', 'eagama.idAgama = mformulir.idAgama')
                ->join('ekelurahan', 'ekelurahan.idKel = mformulir.idKel')
                ->join('ekecamatan', 'ekecamatan.idKec = ekelurahan.idKec')
                ->first();
        } elseif ($konfirmasi == 'c4ca4238a0b923820dcc509a6f75849b') {
            $kode = 1;
            $idPemohon = $this->request->getVar('idPemohon');
            $pemohon = $this->pemohonModel->where('idPemohon', $idPemohon)
                ->join('eagama', 'eagama.idAgama = mpemohon.idAgama')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->join('ekecamatan', 'ekecamatan.idKec = ekelurahan.idKec')
                ->first();
        }
        $data = [
            'bttn' => 'dtpemohon',
            'konfirmasi' => $kode,
            'pemohon' => $pemohon
        ];
        return view('kelurahan/dtpemohon', $data);
    }

    public function dftrpemohon_i()
    {

        $this->cek();
        $idKelurahan = $this->session->get('idLembaga');
        $data = [
            'bttn' => 'dftrpemohon',
            'pemohonBaru' => $this->formulirModel
                ->where('idKel', $idKelurahan)
                ->orderBy('tgInput', 'DESC')
                ->findAll(),
            'pemohon_terdaftar' => $this->pemohonModel->where('idKel', $idKelurahan)
                ->orderBy('updated_at_pmh', 'DESC')
                ->findAll(),
        ];
        return view('kelurahan/kel_dftrpemohon_i', $data);
    }

    //Konfirmasi Pendaftaran
    public function konfirmasi()
    {
        $this->cek();
        $data = [
            'NIK' => $this->request->getVar('nik'),
            'Nama' => $this->request->getVar('nama'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tgLahir' => $this->request->getVar('tgLahir'),
            'gender' => $this->request->getVar('gender'),
            'Alamat' => $this->request->getVar('alamat'),
            'idKel' => $this->request->getVar('kelurahan'),
            'idAgama' => $this->request->getVar('agama'),
            'telepon' => $this->request->getVar('telepon'),
            'email' => $this->request->getVar('email'),
        ];
        if ($this->pemohonModel->save($data)) {
            $idFormulir = $this->request->getVar('idFormulir');
            $this->formulirModel->delete($idFormulir);
            return redirect()->to('/kelurahan/dftrpemohon_i');
        }
    }

    public function hapusForm()
    {
        $this->cek();
        $idFormulir = $this->request->getVar('no');
        if ($this->formulirModel->delete($idFormulir)) {
            return redirect()->to('/kelurahan/dftrpemohon_i');
        }
    }

    public function hapusPemohon()
    {
        $this->cek();
        $idPemohon = $this->request->getVar('no');
        $riwayatAjuan = $this->ajuanModel->where('idPemohon', $idPemohon)->countAllResults();
        if ($riwayatAjuan >= 1) {
            $this->session->setFlashdata('dontDelete', 'Maaf pemohon tidak dapat dihapus, karena sudah masuk di riwayat ajuan');
            return redirect()->to("/kelurahan/dtpemohon?konfirmasi=c4ca4238a0b923820dcc509a6f75849b&idPemohon=$idPemohon");
        } else {
            if ($this->pemohonModel->delete($idPemohon)) {
                return redirect()->to('/kelurahan/dftrpemohon_i');
            }
        }
    }

    public function pengajuanBantuan()
    {
        $this->cek();
        if ($this->request->isAJAX()) {
            $idPemohon = $this->request->getVar('idPemohon');
            $noAjuan = random_int(00000000, 99999999);
            $cekNomorAjuan = $this->ajuanModel->where('noAjuan', $noAjuan)->countAllResults();
            while ($cekNomorAjuan >= 1) {
                $noAjuan = random_int(00000000, 99999999);
                $cekNomorAjuan = $this->ajuanModel->where('noAjuan', $noAjuan)->countAllResults();
            }
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'eSik' => [
                    'label' => 'E-SIK',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mohon pilih status {field} pemohon'
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'esik' => $validation->getError('eSik'),
                    ]
                ];
            } else {
                $data = [
                    'idPemohon' => $idPemohon,
                    'noAjuan' => $noAjuan,
                    'eSik' => $this->request->getVar('eSik'),
                    'idStsAjuan' => 1,
                    'idJnsAjuan' => 0
                ];
                if ($this->ajuanModel->save($data)) {
                    $msg = [
                        'berhasil' => [
                            'noAjuan' => $noAjuan,
                            'link' => "/kelurahan/dftrpemohon_i"
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function dftrajuan_i()
    {
        $this->cek();
        $idKelurahan = $this->session->get('idLembaga');
        $data = [
            'bttn' => 'dftrajuan',
            'ajuan_baru' => $this->ajuanModel
                ->where('trajuan.idStsAjuan', 1)
                ->where('idJnsAjuan =', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->where('idKel', $idKelurahan)
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_proses' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 2)
                ->where('trajuan.idStsAjuan <=', 5)
                ->where('idJnsAjuan =', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('idKel', $idKelurahan)
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_selesai' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 6)
                ->where('idJnsAjuan =', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('idKel', $idKelurahan)
                ->orderBy('tgHasil', 'DESC')
                ->findAll()
        ];

        return view('kelurahan/kel_dftrajuan_i', $data);
    }

    public function dftrajuan_l()
    {
        $this->cek();
        $idKelurahan = $this->session->get('idLembaga');
        $data = [
            'bttn' => 'dftrajuan',
            'ajuan_proses' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 2)
                ->where('trajuan.idStsAjuan <=', 5)
                ->where('trajuan.idJnsAjuan =', 1)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('trlembaga', 'trlembaga.noAjuan = trajuan.noAjuan')
                ->where('idKel', $idKelurahan)
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_selesai' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 6)
                ->where('trajuan.idJnsAjuan =', 1)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('trlembaga', 'trlembaga.noAjuan = trajuan.noAjuan')
                ->where('idKel', $idKelurahan)
                ->orderBy('tgHasil', 'DESC')
                ->findAll()

        ];
        return view('kelurahan/kel_dftrajuan_l', $data);
    }

    public function detailajuan_i($noAjuan)
    {
        $this->cek();
        $ajuan = $this->ajuanModel->where('noAjuan', $noAjuan)
            ->join('estatusajuan as sts', 'sts.idStsAjuan = trajuan.idStsAjuan')
            ->first();
        $data = [
            'bttn' => 'dftrajuan',
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
                ->findAll()
        ];
        return view('kelurahan/kel_detailajuan_i', $data);
    }

    public function detailajuan_l($noAjuan)
    {
        $this->cek();
        $ajuan = $this->ajuanModel->where('noAjuan', $noAjuan)
            ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
            ->join('estatusajuan as sts', 'sts.idStsAjuan = trajuan.idStsAjuan')
            ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
            ->first();
        $data = [
            'bttn' => 'dftrajuan',
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
                ->findAll()
        ];
        return view('kelurahan/kel_detailajuan_l', $data);
    }
}
