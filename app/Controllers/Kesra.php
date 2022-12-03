<?php

namespace App\Controllers;


use App\Models\AjuanModel;
use App\Models\PemohonModel;
use App\Models\UploadModel;
use App\Models\AjuanLbgModel;
use App\Models\KelurahanModel;
use App\Models\KecamatanModel;
use App\Models\MitraModel;
use App\Models\BantuanModel;
use App\Models\SyaratModel;
use App\Models\UsersModel;
use App\Models\PrivModel;
use CodeIgniter\I18n\Time;
use Mpdf\Mpdf;

class Kesra extends BaseController
{
    protected $ajuanModel;
    protected $pemohonModel;
    protected $uploadModel;
    protected $ajuanLbgModel;
    protected $kelurahanModel;
    protected $kecamatanModel;
    protected $mitraModel;
    protected $bantuanModel;
    protected $syaratModel;
    protected $userModel;
    protected $privModel;
    public function __construct()
    {
        $this->session = session();
        $this->ajuanModel = new AjuanModel();
        $this->pemohonModel = new PemohonModel();
        $this->uploadModel = new UploadModel();
        $this->ajuanLbgModel = new AjuanLbgModel();
        $this->kelurahanModel = new KelurahanModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->mitraModel = new MitraModel();
        $this->bantuanModel = new BantuanModel();
        $this->syaratModel = new SyaratModel();
        $this->userModel = new UsersModel();
        $this->privModel = new PrivModel();
    }

    //cek privilege sbg petugas kesra
    public function cek()
    {
        if ($this->session->get('privUser') <> '4') {
            $this->session->destroy();
            return redirect()->to('/home/index');
            exit;
        }
    }

    public function dftrajuan_i()
    {
        $this->cek();
        $data = [
            'bttn' => 'dftrajuan',
            'ajuan_baru' => $this->ajuanModel
                ->where('trajuan.idStsAjuan', 3)
                ->where('idJnsAjuan', 0)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_proses' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 2)
                ->where('trajuan.idStsAjuan <=', 5)
                ->where('trajuan.idStsAjuan !=', 3)
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
                ->findAll()
        ];
        return view('kesra/dftrajuan_i', $data);
    }
    public function dftrajuan_l()
    {
        $this->cek();
        $data = [
            'bttn' => 'dftrajuan',
            'ajuan_baru' => $this->ajuanModel
                ->where('trajuan.idStsAjuan', 3)
                ->where('trajuan.idJnsAjuan', 1)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('trlembaga', 'trlembaga.noAjuan = trajuan.noAjuan')
                ->orderBy('tgHasil', 'DESC')
                ->findAll(),
            'ajuan_proses' => $this->ajuanModel
                ->where('trajuan.idStsAjuan >=', 4)
                ->where('trajuan.idStsAjuan <=', 5)
                ->where('trajuan.idJnsAjuan', 1)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('estatusajuan', 'estatusajuan.idStsAjuan = trajuan.idStsAjuan')
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->join('trlembaga', 'trlembaga.noAjuan = trajuan.noAjuan')
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
                ->orderBy('tgHasil', 'DESC')
                ->findAll()

        ];
        return view('kesra/dftrajuan_l', $data);
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
                ->findAll(),
            'riwayat' => $this->ajuanModel->where('idPemohon', $ajuan['idPemohon'])
                ->where('noAjuan !=', $noAjuan)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('estatusajuan as sts', 'sts.idStsAjuan = trajuan.idStsAjuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')->findAll()
        ];
        return view('kesra/detailajuan_i', $data);
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
                ->findAll(),
            'riwayat' => $this->ajuanModel->where('idPemohon', $ajuan['idPemohon'])
                ->where('noAjuan !=', $noAjuan)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('estatusajuan as sts', 'sts.idStsAjuan = trajuan.idStsAjuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')->findAll()
        ];
        return view('kesra/detailajuan_l', $data);
    }

    public function updateAjuan()
    {
        $this->cek();
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
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
                        'rec' => $validation->getError('rekomendasi'),
                        'token' => csrf_hash(),
                    ]
                ];
            } else {
                $data = [
                    'idRecKesra' => $this->request->getVar('rekomendasi'),
                    'ketRecKesra' => $this->request->getVar('ketRecKesra'),
                    'tgRecKesra' => new Time('now', 'Asia/Jakarta', 'en_US'),
                    'idStsAjuan' => 4
                ];
                $save = $this->ajuanModel->where('idAjuan', $this->request->getVar('idAjuan'))->set($data)->update();
                if ($save) {
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Data rekomendasi berhasil disimpan',
                        ]
                    ];
                } else {
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'Data gagal disimpan, terjadi kesalahan teknis'
                        ]
                    ];
                }
                // if ($this->lembagaModel->transStatus() === false) {
                //     $this->lembagaModel->transRollback();
                //     $msg = [
                //         'gagal' => [
                //             'pesan' => 'Data lembaga tidak dapat disimpan'
                //         ]
                //     ];
                // } else {
                //     $this->lembagaModel->transCommit();
                //     $msg = [
                //         'berhasil' => [
                //             'pesan' => 'Data ajuan dan lembaga berhasil disimpan. Simpan nomor ajuan ini untuk melihat proses ajuan Anda!',
                //             'nomor_ajuan' => $noAjuan,
                //         ]
                //     ];
                // }
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
            // dd($this->request->getPost());
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
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $semuaKecamatan[$kec['Kecamatan']] = $countAjuanKecamatan;
            //arsort($semuaKelurahan);
        }
        // Untuk statistik mitra
        $dftrMitra = $this->mitraModel->findAll();
        foreach ($dftrMitra as $mit) {
            $countAjuanMitra = $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                //->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                //->where('idKel', $idMitra)                
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
                //->where('idMitra', $idMitra)
                ->where('trajuan.kodeBantuan', $ban['kodeBantuan'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $semuaBantuan[] = $countAjuanBantuan;
        }
        $data = [
            'countPermintaan' => $this->ajuanModel
                ->where('idStsAjuan', 3)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countProses' => $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->where('idStsAjuan <', 6)
                ->where('idStsAjuan !=', 3)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDitolak' => $this->ajuanModel
                ->where('idStsAjuan', 6)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDisetujui' => $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'totalDana' => $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->first(),
            'countKelurahan' => $semuaKelurahan,
            'countKecamatan' => $semuaKecamatan,
            'countMitra' => $semuaMitra,
            'daftarMitra' => $dftrMitra,
            'countBantuan' => $semuaBantuan,
            'daftarBantuan' => $dftrBantuan,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'norm_tglAwal' => $tgAwal,
            'norm_tglAkhir' => $tgAhir,
            'filter' => $filter,
            'bttn' => 'dashboard_kesra',
            'halaman' => 'kesra'
        ];
        return view('kesra/dashboard', $data);
    }

    public function dftrMitra()
    {
        $data = [
            'bttn' => 'dftrmitra',
            'mitra' => $this->mitraModel->findAll()
        ];
        return view('kesra/dftrmitra', $data);
    }

    public function dftrBantuan()
    {
        $data = [
            'bttn' => 'dftrbantuan',
            'bantuan' => $this->bantuanModel
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->findAll()
        ];
        return view('kesra/dftrbantuan', $data);
    }

    public function editProgram()
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
            'bttn' => 'dftrbantuan',
            'bantuan' => $bantuan,
            'syaratProgram' => $syaratProgram
        ];
        return view('kesra/editProgram', $data);
    }

    public function frEditSyarat()
    {
        if ($this->request->isAJAX()) {
            $idSyarat = $this->request->getVar('idSyarat');
            $data = [
                'syarat' => $this->syaratModel->find($idSyarat)
            ];
            $msg = [
                'sukses' => view('tambahan/frEditSyarat', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf perintah tidak dapat diproses');
        }
    }

    public function doEditSyarat()
    {
        if ($this->request->isAJAX()) {
            $idSyarat = $this->request->getVar('idSyarat');
            $data = [
                'Syarat' => $this->request->getVar('namaSyarat'),
                'StatusSyarat' => $this->request->getVar('StatusSyarat')
            ];
            if ($this->syaratModel->update($idSyarat, $data)) {
                $msg = [
                    'berhasil' => "Syarat berhasil diupdate"
                ];
            } else {
                $msg = [
                    'gagal' => "Syarat gagal diupdate"
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf perintah tidak dapat diproses');
        }
    }

    public function doHapusSyarat()
    {
        if ($this->request->isAJAX()) {
            $idSyarat = $this->request->getVar('idSyarat');
            $cekRiwayat = $this->uploadModel->where('idSyarat', $idSyarat)->countAllResults();
            if ($cekRiwayat >= 1) {
                $msg = [
                    'notallowed' => "Mohon maaf, syarat sudah digunakan dalam riwayat ajuan. Jika memang syarat sudah tidak berlaku, Anda bisa me-nonaktifkan melalui menu edit dan menambah syarat baru jika diperlukan"
                ];
            } else {
                if ($this->syaratModel->delete($idSyarat)) {
                    $msg = [
                        'berhasil' => "Syarat berhasil dihapus"
                    ];
                } else {
                    $msg = [
                        'gagal' => "Syarat gagal dihapus"
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Maaf perintah tidak dapat diproses');
        }
    }

    public function doTambahSyarat()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'kodeBantuan' => $this->request->getVar('kodeBantuan'),
                'Syarat' => $this->request->getVar('namaSyarat'),
                'StatusSyarat' => $this->request->getVar('StatusSyarat'),
            ];
            if ($this->syaratModel->save($data)) {
                $msg = [
                    'berhasil' => "Syarat berhasil ditambahkan"
                ];
            } else {
                $msg = [
                    'gagal' => "Syarat gagal ditambahkan"
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf perintah tidak dapat diproses');
        }
    }

    public function doEditProgram()
    {
        if ($this->request->isAJAX()) {
            $idBantuan = $this->request->getVar('idBantuan');
            $data = [
                'namaProgram' => $this->request->getVar('namaProgram'),
                'StatusProgram' => $this->request->getVar('StatusProgram'),
                'desBantuan' => htmlspecialchars($this->request->getVar('desBantuan')),
                'tahun' => htmlspecialchars($this->request->getVar('tahun')),
                'kuota' => htmlspecialchars($this->request->getVar('kuota')),
                'NilaiBantuan' => htmlspecialchars($this->request->getVar('nilaiBantuan'), ENT_IGNORE)
            ];
            if ($this->bantuanModel->update($idBantuan, $data)) {
                $msg = [
                    'berhasil' => "Program Berhasil diupdate",
                    'link' => "/kesra/dftrBantuan",
                ];
            } else {
                $msg = [
                    'gagal' => "Program gagal diupdate",
                    'link' => "/kesra/dftrBantuan",
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf perintah tidak dapat diproses');
        }
    }

    public function frTambahProgram()
    {
        $data = [
            'bttn' => 'dftrbantuan',
            'mitra' => $this->mitraModel->findAll(),
            'mitra2' => $this->mitraModel->where('idMitra', $this->session->get('idLembaga'))->findAll()
        ];
        return view('kesra/frTambahProgram', $data);
    }

    public function createKodeBantuan()
    {
        if ($this->request->isAJAX()) {
            $idMitra = $this->request->getPost('idMitra');
            $Bantuan = $this->bantuanModel->where('idMitra', $idMitra)->findAll();
            $mitra = $this->mitraModel->where('idMitra', $idMitra)->first();
            if ($Bantuan) {
                foreach ($Bantuan as $bantuan) {
                    $kode = explode('-', $bantuan['kodeBantuan']);
                    $Angka[] = $kode[1];
                }
                $angkaTertinggi = max($Angka);
                $kodeAngka = $angkaTertinggi + 1;
            } else {
                $kodeAngka = 1;
            }
            $msg = [
                'sukses' => [
                    'kodeMitra' => $mitra['NamaMitra'],
                    'kodeAngka' => $kodeAngka
                ]
            ];
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function doTambahProgram()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'kodeBantuan' => $this->request->getPost('kodeBantuan'),
                'namaProgram' => $this->request->getPost('namaProgram'),
                'StatusProgram' => $this->request->getPost('StatusProgram'),
                'desBantuan' => htmlspecialchars($this->request->getPost('desBantuan')),
                'idMitra' => $this->request->getPost('idMitra'),
                'tahun' => htmlspecialchars($this->request->getVar('tahun')),
                'kuota' => htmlspecialchars($this->request->getVar('kuota')),
                'NilaiBantuan' => htmlspecialchars($this->request->getVar('nilaiBantuan'))
            ];
            if ($this->bantuanModel->save($data)) {
                $kodeBantuan = $this->request->getPost('kodeBantuan');
                $namaSyarat = $this->request->getVar('Syarat');
                $StatusSyarat = $this->request->getVar('StatusSyarat');

                $jmlSyarat = count($namaSyarat);

                for ($i = 0; $i < $jmlSyarat; $i++) {
                    $this->syaratModel->insert([
                        'kodeBantuan' => $kodeBantuan,
                        'Syarat' => $namaSyarat[$i],
                        'StatusSyarat' => $StatusSyarat[$i]
                    ]);
                }
                $msg = [
                    'sukses' => [
                        'pesan' => "Program berhasil disimpan",
                        'link' => "/kesra/dftrBantuan"
                    ]
                ];
            }
            echo json_encode($msg);
        } else {
            exit("Maaf perintah tidak dapat diproses");
        }
    }

    public function doHapusProgram()
    {
        if ($this->request->isAJAX()) {
            $kodeBantuan = $this->request->getVar('kodeBantuan');
            $cekRiwayat = $this->ajuanModel->where('kodeBantuan', $kodeBantuan)->countAllResults();
            if ($cekRiwayat >= 1) {
                $msg = [
                    'notallowed' => "Mohon maaf, program sudah digunakan dalam riwayat ajuan. Jika memang program sudah tidak berlaku, Anda bisa me-nonaktifkan melalui menu edit dan menambah program baru jika diperlukan"
                ];
            } else {
                if ($this->bantuanModel->where('kodeBantuan', $kodeBantuan)->delete()) {
                    $msg = [
                        'berhasil' => "Program berhasil dihapus"
                    ];
                } else {
                    $msg = [
                        'gagal' => "Program gagal dihapus"
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Maaf perintah tidak dapat diproses');
        }
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
                ->where('idStsAjuan >', 1)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $kel['idKel'])
                ->countAllResults();
            $countKelurahanSetuju = $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $kel['idKel'])
                ->countAllResults();
            $danaKel = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
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
                ->where('idStsAjuan >', 1)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $mit['idMitra'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $semuaMitra[$mit['NamaMitra']] = $countAjuanMitra;
            $countMitraSetuju = $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mmitra', 'mmitra.idMitra = trbantuan.idMitra')
                ->where('trbantuan.idMitra', $mit['idMitra'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $mitraSetuju[] = $countMitraSetuju;
            $dana = $this->ajuanModel->selectSum('nilaiDisetujui')
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
                ->where('idStsAjuan >=', 2)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                //->where('idMitra', $idMitra)
                ->where('trajuan.kodeBantuan', $ban['kodeBantuan'])
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults();
            $danaBantuan = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                //->where('idMitra', $idMitra)
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
                ->countAllResults(),
            'countProses' => $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->where('idStsAjuan <', 6)
                //->where('idStsAjuan !=', 3)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDitolak' => $this->ajuanModel
                ->where('idStsAjuan', 6)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'countDisetujui' => $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
                ->countAllResults(),
            'totalDana' => $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('tgHasil >=', $tgAwal)
                ->where('tgHasil <=', $tgAhir)
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
            'halaman' => 'kesra'
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

    public function userManagement()
    {
        $data = [
            'bttn' => 'user_mng',
            'muser' => $this->userModel->join('eprivuser', 'eprivuser.idPrivUser = muser.idPrivUser')
                ->findAll(),
            'privUser' => $this->privModel->where('idPrivUser >', 1)->findAll()
        ];
        return view('kesra/user_management', $data);
    }

    public function editUser()
    {
        $idUser = $this->request->getGet('kode');
        $data = [
            'bttn' => 'user_mng',
            'dataUser' => $this->userModel->where('idUser', $idUser)
                ->join('eprivuser', 'eprivuser.idPrivUser = muser.idPrivUser')->first()
        ];
        return view('kesra/edit_user', $data);
    }

    public function doEditUser()
    {
        $idUser = $this->request->getVar('idUser');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'pengguna' => [
                'label' => 'Pengguna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            // is_unique[table.field,ignore_field,ignore_value]
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[muser.User,idUser,{idUser}]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah digunakan',
                ]
            ],
            'new_pass' => [
                'label' => 'New Password',
                'rules' => 'required|min_length[8]|max_length[200]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 8 karakter',
                    'max_length' => '{field} maksimal 200 karakter',
                ]
            ],
            'conf_pass' => [
                'label' => 'Confirm Password',
                'rules' => 'matches[new_pass]',
                'errors' => [
                    'required' => '{field} salah',
                ]
            ],
        ]);

        if (!$valid) {
            $this->session->setFlashdata('errorPengguna', $validation->getError('pengguna'));
            $this->session->setFlashdata('errorUser', $validation->getError('username'));
            $this->session->setFlashdata('errorPassword', $validation->getError('new_pass'));
            $this->session->setFlashdata('errorConfPassword', $validation->getError('conf_pass'));
            return redirect()->to("/kesra/editUser?kode=$idUser")->withInput();
        } else {
            $dataSimpan = [
                'Namauser' => $this->request->getVar('pengguna'),
                'User' => $this->request->getVar('username'),
                'Password' => sha1($this->request->getVar('new_pass')),
                'email' => $this->request->getVar('email'),
                'telepon' => $this->request->getVar('telepon')
            ];
            if ($this->userModel->update($idUser, $dataSimpan)) {
                $this->session->setFlashdata('berhasilUpdate', "Data berhasil diupdate");
                if ($this->session->get('privUser') == 4) {
                    return redirect()->to("/kesra/userManagement");
                } else {
                    return redirect()->to("/gerbangska/logout");
                }
            } else {
                $this->session->setFlashdata('gagalUpdate', "Data gagal diupdate");
                if ($this->session->get('privUser') == 4) {
                    return redirect()->to("/kesra/userManagement");
                } else {
                    return redirect()->to("/gerbangska/logout");
                }
            }
        }
    }

    public function doTambahUser()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pengguna' => [
                    'label' => 'Pengguna',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'lembaga' => [
                    'label' => 'Lembaga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                // is_unique[table.field,ignore_field,ignore_value]
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[muser.User]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah digunakan',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]|max_length[100]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 8 karakter',
                        'max_length' => '{field} maksimal 100 karakter',
                    ]
                ],
                'confirm_password' => [
                    'label' => 'Confirm Password',
                    'rules' => 'matches[password]',
                    'errors' => [
                        'required' => '{field} tidak sesuai',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'pengguna' => $validation->getError('pengguna'),
                        'lembaga' => $validation->getError('lembaga'),
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                        'confirm_password' => $validation->getError('confirm_password'),
                        'token' => csrf_hash()
                    ]
                ];
            } else {
                $lembaga = $this->request->getPost('lembaga');
                if ($lembaga == 'pemerintah') {
                    $kode_lbg = 0;
                } else {
                    $kode_lbg = $lembaga;
                }
                $dataSimpan = [
                    'idPrivUser' => $this->request->getVar('privUser'),
                    'Namauser' => $this->request->getVar('pengguna'),
                    'User' => $this->request->getVar('username'),
                    'Password' => sha1($this->request->getVar('confirm_password')),
                    'idLembaga' => $kode_lbg,
                ];
                if ($this->userModel->save($dataSimpan)) {
                    $msg = [
                        'berhasil' => [
                            'pesan' => 'User baru berhasil ditambahkan',
                        ]
                    ];
                } else {
                    $msg = [
                        'gagal' => [
                            'pesan' => 'User baru gagal ditambahkan',
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Maaf perintah anda tidak dapat diproses');
        }
    }

    public function doHapusUser()
    {
        if ($this->request->isAJAX()) {
            $id_user = $this->request->getVar('id_user');

            if ($this->userModel->where('idUser', $id_user)->delete()) {
                $msg = [
                    'berhasil' => "User berhasil dihapus"
                ];
            } else {
                $msg = [
                    'gagal' => "User gagal dihapus"
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf perintah tidak dapat diproses');
        }
    }

    public function mitraPdf()
    {
        $idMitra = $this->request->getVar('idMitra');
        $mitra = $this->mitraModel->where('idMitra', $idMitra)->first();
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
        if ($this->request->getVar('periode') != 'semua') {
            $thAwal = $this->request->getVar('periode');
            $thAkhir = $this->request->getVar('periode');
        } else {
            //$tgAwal = Time::parse('March 9, 2016 12:00:00', 'Asia/Jakarta');
            // $tgAwal = 0000 - 00 - 00;
            $thAwal = 0000;
            $tglAkhir = new Time('now', 'Asia/Jakarta', 'en_US');
            $thAkhir = $tglAkhir->getYear();
            $tglAwal = "Semua Data";
            $tglAkhir = "";
        }

        // dd($thAkhir);
        //Untuk statistik kelurahan
        $dftrKelurahan = $this->kelurahanModel->findAll();
        foreach ($dftrKelurahan as $kel) {
            $countAjuanKelurahan = $this->ajuanModel
                ->where('idStsAjuan >', 1)
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('idKel', $kel['idKel'])
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults();
            $countKelurahanSetuju = $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
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
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
                ->first();
            $semuaKelurahan[$kel['Kelurahan']] = array($countAjuanKelurahan, $countKelurahanSetuju, $danaKel['nilaiDisetujui']);
            arsort($semuaKelurahan);
        }
        //Untuk statistik kecamatan
        $dftrKecamatan = $this->kecamatanModel->findAll();
        foreach ($dftrKecamatan as $kec) {
            $countAjuanKecamatan = $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->where('idKec', $kec['idKec'])
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults();
            $countDisetujuiKec = $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->join('ekelurahan', 'ekelurahan.idKel = mpemohon.idKel')
                ->where('idKec', $kec['idKec'])
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults();
            $danaKec = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
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
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
                ->countAllResults();
            $danaBantuan = $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->join('mpemohon', 'mpemohon.NIK = trajuan.idPemohon')
                ->where('trajuan.kodeBantuan', $ban['kodeBantuan'])
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
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
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->countAllResults(),
            'countProses' => $this->ajuanModel
                ->where('idStsAjuan >=', 2)
                ->where('idStsAjuan <', 6)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('idMitra', $idMitra)
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
                ->countAllResults(),
            'countDitolak' => $this->ajuanModel
                ->where('idStsAjuan', 6)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
                ->where('idMitra', $idMitra)
                ->countAllResults(),
            'countDisetujui' => $this->ajuanModel
                ->where('idStsAjuan', 7)
                ->join('trbantuan', 'trbantuan.kodeBantuan = trajuan.kodeBantuan')
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
                ->where('idMitra', $idMitra)
                ->countAllResults(),
            'totalDana' => $this->ajuanModel->selectSum('nilaiDisetujui')
                ->where('year(tgHasil) >=', $thAwal)
                ->where('year(tgHasil) <=', $thAkhir)
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
            'thAwal' => $thAwal,
            'tglNow' => $tglSekarang,
            'filter' => $this->request->getVar('periode'),
            'halaman' => 'mitra',
            'mitra' => $this->mitraModel->find($idMitra)
        ];
        $mpdf = new Mpdf([
            'debug' => TRUE, 'mode' => 'utf-8', 'format' => 'A4-P',
            'margin_top' => 8, 'margin_bottom' => 10, 'margin_left' => 12, 'margin_right' => 12
        ]);

        $html = view('kesra/pdf_mitra.php', $data);
        $mpdf->text_input_as_HTML = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($mitra['NamaMitra'] . ".pdf", 'D');

        // if ($mpdf->Output($mitra['NamaMitra'] . ".pdf", 'D')) {
        //     $msg = [
        //         'berhasil' => "Program Berhasil diupdate",
        //         'link' => "/kesra/dftrBantuan",
        //     ];
        // } else {
        //     $msg = [
        //         'gagal' => "Program gagal diupdate",
        //         'link' => "/kesra/dftrBantuan",
        //     ];
        // }
        //     echo json_encode($msg);
        // } else {
        //     exit('Maaf perintah tidak dapat diproses');
        // }
    }

    public function hapus_ajuan()
    {
        if ($this->request->isAJAX()) {
            $no_ajuan = $this->request->getPost('no_ajuan');
            // print_r($no_ajuan);
            $delete = $this->ajuanModel->where('noAjuan', $no_ajuan)->delete();
            if ($delete) {
                $msg = [
                    'berhasil' => [
                        'pesan' => 'Data rekomendasi berhasil dihapus',
                    ]
                ];
            } else {
                $msg = [
                    'gagal' => [
                        'pesan' => 'Data gagal dihapu, terjadi kesalahan teknis'
                    ]
                ];
            }

            echo json_encode($msg);
        }
    }
}
