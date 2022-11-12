<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Gerbangska extends BaseController
{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
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
        // $this->session->set(['hsl' => $hasil]);
        $data = [
            'text' => $text,
            'hasil' => $hasil,
        ];
        return view('auth/login', $data);
    }

    public function cekuser()
    {
        $usersModel = new UsersModel();
        $hslbenar = $this->request->getVar('hslbenar');
        $jawaban = $this->request->getVar('jawabCpt');
        if (md5($jawaban) == $hslbenar) {
            $User = $this->request->getVar('User');
            $pass = $this->request->getVar('Password');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'User' => [
                    'label' => 'User',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],

                'Password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $this->session->setFlashdata('errorUser', $validation->getError('User'));
                $this->session->setFlashdata('errorPassword', $validation->getError('Password'));
                return redirect()->to('/gerbangska/index')->withInput();
                // return redirect()->to('/people/edit/' . $this->request->getVar('slug'))->withInput()
            } else {

                $result = $usersModel->where('User', $User)->first();
                if ($result) {
                    $password = $result['Password'];
                    //$verify_pass = password_verify($pass, $password);
                    if (sha1($pass) == $password) {
                        //if($verify_pass){
                        $dapat_session = [
                            'login' => true,
                            'namauser' => $result['Namauser'],
                            'user' => $result['User'],
                            'idUser' => $result['idUser'],
                            'idLembaga' => $result['idLembaga'],
                            'privUser' => $result['idPrivUser'],
                            'email' => $result['email'],
                            'telepon' => $result['telepon']
                        ];
                        $this->session->set($dapat_session);

                        if ($this->session->get('privUser') == 2) {
                            return redirect()->to('/kelurahan/dashboard');
                        } elseif ($this->session->get('privUser') == 3) {
                            return redirect()->to('/dinsos/dftrajuan_i');
                        } elseif ($this->session->get('privUser') == 4) {
                            return redirect()->to('/kesra/dashboard');
                        } elseif ($this->session->get('privUser') == 5) {
                            return redirect()->to('/mitra/dftrajuan_i');
                        } else {
                            $this->session->destroy();
                            return redirect()->to('/gerbangska/index');
                        }
                    } else {
                        $this->session->setFlashdata('errorPassword', 'Maaf Password Anda salah');
                        return redirect()->to('/gerbangska/index')->withInput();
                    }
                } else {
                    $this->session->setFlashdata('errorUser', 'Maaf User tidak ditemukan');
                    return redirect()->to('/gerbangska/index')->withInput();
                }
            }
        } else {
            $this->session->setFlashdata('errorHitung', 'Maaf, jawaban Anda salah');
            return redirect()->to('/gerbangska/index')->withInput();
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/home/index');
    }

    public function edit_user()
    {
        $usersModel = new UsersModel();
        $idUser = $this->session->get('idUser');
        $data = [
            'bttn' => 'user_mng',
            'dataUser' => $usersModel->where('idUser', $idUser)
                ->join('eprivuser', 'eprivuser.idPrivUser = muser.idPrivUser')->first()
        ];
        return view('kesra/edit_user', $data);
    }

    //--------------------------------------------------------------------

}
