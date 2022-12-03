<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'pemohonFilter' => \App\Filters\PemohonFilters::class,
        'kelurahanFilter' => \App\Filters\KelurahanFilters::class,
        'dinsosFilter' => \App\Filters\DinsosFilters::class,
        'kesraFilter' => \App\Filters\KesraFilters::class,
        'mitraFilter' => \App\Filters\MitraFilters::class
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            'csrf' => ['except' => [
                'Home', 'home/*',
                'Pemohon', 'pemohon/form_syarat',
                'Kesra', 'kesra/frEditSyarat',
                'Kesra', 'kesra/doHapusSyarat',
                'Kesra', 'kesra/createKodeBantuan',
                'Kesra', 'kesra/mitraPdf',
                'Dinamis', 'dinamis/*'
            ]],
            'pemohonFilter' => ['except' => [
                'gerbangska', 'gerbangska/*',
                'home', 'home/*',
                'pemohon', 'pemohon/frpemohon',
                'pemohon', 'pemohon/proses_daftar',
                'pemohon', 'pemohon/cetak_noajuan/*',
                'pemohon', 'pemohon/prosesCekAjuan',
                'pemohon', 'pemohon/prosesCekAjuan',
                'pemohon', 'pemohon/formulir_ajuan_v2',
                'pemohon', 'pemohon/ajukanBantuan',
                'Dinamis', 'dinamis/*'
            ]],
            'kelurahanFilter' => ['except' => [
                'gerbangska', 'gerbangska/*',
                'home', 'home/*',
                'pemohon', 'pemohon/frpemohon',
                'pemohon', 'pemohon/proses_daftar',
                'pemohon', 'pemohon/cetak_noajuan/*',
                'pemohon', 'pemohon/prosesCekAjuan',
                'pemohon', 'pemohon/prosesCekAjuan',
                'pemohon', 'pemohon/formulir_ajuan_v2',
                'pemohon', 'pemohon/ajukanBantuan',
                'Dinamis', 'dinamis/*'
            ]],
            'dinsosFilter' => ['except' => [
                'gerbangska', 'gerbangska/*',
                'home', 'home/*',
                'pemohon', 'pemohon/frpemohon',
                'pemohon', 'pemohon/proses_daftar',
                'pemohon', 'pemohon/cetak_noajuan/*',
                'pemohon', 'pemohon/prosesCekAjuan',
                'pemohon', 'pemohon/prosesCekAjuan',
                'pemohon', 'pemohon/formulir_ajuan_v2',
                'pemohon', 'pemohon/ajukanBantuan',
                'Dinamis', 'dinamis/*'
            ]],
            'kesraFilter' => ['except' => [
                'gerbangska', 'gerbangska/*',
                'home', 'home/*',
                'pemohon', 'pemohon/frpemohon',
                'pemohon', 'pemohon/proses_daftar',
                'pemohon', 'pemohon/cetak_noajuan/*',
                'pemohon', 'pemohon/prosesCekAjuan',
                'pemohon', 'pemohon/prosesCekAjuan',
                'pemohon', 'pemohon/formulir_ajuan_v2',
                'pemohon', 'pemohon/ajukanBantuan',
                'Dinamis', 'dinamis/*'
            ]],
            'mitraFilter' => ['except' => [
                'gerbangska', 'gerbangska/*',
                'home', 'home/*',
                'pemohon', 'pemohon/frpemohon',
                'pemohon', 'pemohon/proses_daftar',
                'pemohon', 'pemohon/cetak_noajuan/*',
                'pemohon', 'pemohon/prosesCekAjuan',
                'pemohon', 'pemohon/prosesCekAjuan',
                'pemohon', 'pemohon/formulir_ajuan_v2',
                'pemohon', 'pemohon/ajukanBantuan',
                'Dinamis', 'dinamis/*'
            ]],
        ],
        //yang boleh diakses setelah login
        'after'  => [
            'toolbar',
            // 'honeypot',
            'pemohonFilter' => ['except' => [
                'pemohon', 'pemohon/*',
                'Dinamis', 'dinamis/*'
            ]],
            'kelurahanFilter' => ['except' => [
                'kelurahan', 'kelurahan/*',
                'kelurahan', 'kelurahan/*/*',
                'pemohon', 'pemohon/alur_bantuan',
                'gerbangska', 'gerbangska/edit_user',
                'Dinamis', 'dinamis/*'
            ]],
            'dinsosFilter' => ['except' => [
                'dinsos', 'dinsos/*',
                'dinsos', 'dinsos/*/*',
                'gerbangska', 'gerbangska/edit_user',
                'Dinamis', 'dinamis/*'
            ]],
            'kesraFilter' => ['except' => [
                'kesra', 'kesra/*',
                'kesra', 'kesra/*/*',
                'mitra', 'mitra/dashboard',
                'gerbangska', 'gerbangska/edit_user',
                'Dinamis', 'dinamis/*'
            ]],
            'mitraFilter' => ['except' => [
                'mitra', 'mitra/*',
                'mitra', 'mitra/*/*',
                'kesra', 'kesra/editProgram',
                'kesra', 'kesra/frEditSyarat',
                'kesra', 'kesra/doEditSyarat',
                'kesra', 'kesra/doHapusSyarat',
                'kesra', 'kesra/doTambahSyarat',
                'kesra', 'kesra/doEditProgram',
                'kesra', 'kesra/frTambahProgram',
                'kesra', 'kesra/createKodeBantuan',
                'kesra', 'kesra/doTambahProgram',
                'kesra', 'kesra/doHapusProgram',
                'gerbangska', 'gerbangska/edit_user',
                'Dinamis', 'dinamis/*'
            ]],
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
