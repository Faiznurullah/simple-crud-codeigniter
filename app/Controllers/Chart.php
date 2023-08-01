<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Belanja;

class Chart extends BaseController
{
    public function index()
    {
        $data = new Belanja();
        $dataBelanja = $data->findAll();
        
        
        
        $bulanLabels = []; // Inisialisasi array untuk menyimpan label tanggal
        $dataPerTanggal = []; // Inisialisasi array untuk menyimpan data total jumlah belanja
        // Mendapatkan tanggal satu bulan lalu
        $tanggalSatuBulanLalu = date('Y-m-d', strtotime('-1 month'));
        
        // Mendapatkan tanggal saat ini
        $tanggalSekarang = date('Y-m-d');
        
        $dataBelanjaBulan = $data->select('DATE(created_at) as tanggal, COUNT(id) as total_jumlah')
        ->where('created_at >=', $tanggalSatuBulanLalu)
        ->where('created_at <=', $tanggalSekarang)
        ->groupBy('DATE(created_at)')
        ->findAll();
        
        foreach ($dataBelanjaBulan as $belanja) {
            $tanggal = date('Y-m-d', strtotime($belanja['tanggal'])); // Konversi tanggal ke format 'Y-m-d'
            $bulanLabels[] = $tanggal; // Tambahkan tanggal ke array label
            $dataPerTanggal[] = (int) $belanja['total_jumlah']; // Tambahkan total jumlah belanja ke array data
        }

        // Buat objek chart.js
        $JumlahChart['datajumlahbulan'] = [
            'type' => 'line', // Anda dapat menggunakan jenis chart yang sesuai dengan kebutuhan
            'data' => [
                'labels' => $bulanLabels, // Gunakan array label tanggal
                'datasets' => [
                    [
                        'label' => 'Total Belanja per Tanggal',
                        'data' => $dataPerTanggal, // Gunakan array data per tanggal
                        'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                        'borderColor' => 'rgba(75, 192, 192, 1)',
                        'borderWidth' => 1,
                        ]
                        ]
                    ],
                    'options' => [
                        'scales' => [
                            'y' => [
                                'beginAtZero' => true
                                ]
                                ]
                                ]
                            ];
                            
                            // Mendapatkan tanggal awal tahun
                            $tanggalAwalTahun = date('Y-01-01');
                            
                            // Mendapatkan tanggal saat ini
                            $tanggalSekarang = date('Y-m-d');
                            
                            $dataBelanja = $data->select('MONTH(created_at) as bulan, COUNT(id) as total_jumlah')
                            ->where('created_at >=', $tanggalAwalTahun)
                            ->where('created_at <=', $tanggalSekarang)
                            ->groupBy('MONTH(created_at)')
                            ->findAll();
                            
                            // Inisialisasi array bulanLabels
                            $bulanLabels = [
                                'January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November', 'December'
                            ];
                            
                            // Inisialisasi array dataPerBulan untuk menyimpan jumlah data per bulan
                            $dataPerBulan = array_fill(1, 12, 0);
                            
                            // Loop melalui dataBelanja dan mengisi array dataPerBulan sesuai dengan jumlah data per bulan
                            foreach ($dataBelanja as $belanja) {
                                $bulan = (int) $belanja['bulan']; // Ambil bulan dari hasil query
                                $totalJumlah = (int) $belanja['total_jumlah']; // Ambil total jumlah dari hasil query
                                $dataPerBulan[$bulan] = $totalJumlah; // Masukkan total jumlah ke array dataPerBulan
                            }
                            
                            // Loop melalui array dataPerBulan dan mengisi array bulanLabels sesuai dengan jumlah data per bulan
                            $bulanLabelsFiltered = [];
                            for ($i = 1; $i <= date('n'); $i++) {
                                $bulanLabelsFiltered[] = $bulanLabels[$i - 1] . ' (' . $dataPerBulan[$i] . ')';
                            }
                            
                            
                            
                            
                            // Buat objek chart.js
                            $JumlahChart['datajumlahtahun'] = [
                                'type' => 'line',
                                'data' => [
                                    'labels' => $bulanLabelsFiltered, // Gunakan array label bulan
                                    'datasets' => [
                                        [
                                            'label' => 'Total Belanja per Bulan',
                                            'data' => $dataPerBulan, // Gunakan array data per bulan
                                            'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                                            'borderColor' => 'rgba(75, 192, 192, 1)',
                                            'borderWidth' => 1,
                                            ]
                                            ]
                                        ],
                                        'options' => [
                                            'scales' => [
                                                'y' => [
                                                    'beginAtZero' => true
                                                    ]
                                                    ]
                                                    ]
                                                ];
                                                
                                                
                                                // Mendapatkan tanggal satu minggu yang lalu
                                                $tanggalSatuMingguLalu = date('Y-m-d', strtotime('-1 week'));
                                                
                                                // Query untuk mendapatkan data belanja dalam satu minggu
                                                $dataBelanja = $data->select('DATE(created_at) as tanggal, COUNT(id) as total_jumlah')
                                                ->where('created_at >=', $tanggalSatuMingguLalu)
                                                ->groupBy('DATE(created_at)')
                                                ->findAll();
                                                
                                                // Inisialisasi array untuk menyimpan label-label tanggal
                                                $labels = [];
                                                // Inisialisasi array untuk menyimpan data jumlah belanja per tanggal
                                                $dataPerTanggal = [];
                                                
                                                // Looping untuk mengisi array label-label tanggal dan data jumlah belanja per tanggal
                                                foreach ($dataBelanja as $data) {
                                                    $labels[] = $data['tanggal']; // Memasukkan tanggal ke array label-label
                                                    $dataPerTanggal[] = $data['total_jumlah']; // Memasukkan data jumlah belanja ke array data per tanggal
                                                }
                                                
                                                $JumlahChart['datajumlahminggu'] = [
                                                    'type' => 'line',
                                                    'data' => [
                                                        'labels' => $labels, // Menggunakan array label-label tanggal yang telah diisi
                                                        'datasets' => [
                                                            [
                                                                'label' => 'Total Belanja per Tanggal',
                                                                'data' => $dataPerTanggal, // Menggunakan array data jumlah belanja per tanggal
                                                                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                                                                'borderColor' => 'rgba(75, 192, 192, 1)',
                                                                'borderWidth' => 1,
                                                                ]
                                                                ]
                                                            ],
                                                            'options' => [
                                                                'scales' => [
                                                                    'y' => [
                                                                        'beginAtZero' => true
                                                                        ]
                                                                        ]
                                                                        ]
                                                                    ];
                                                                    
                                                                    
                                                                    
                                                        return view('chart', $JumlahChart);


                                                                }
                                                            }
                                                            