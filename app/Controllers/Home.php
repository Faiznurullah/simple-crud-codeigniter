<?php

namespace App\Controllers;
use App\Models\Belanja;
use App\Models\Uploadtransaksi;
use CodeIgniter\Validation\Rules;


class Home extends BaseController
{
    public function index()
    {
        $ModelBelanja = new Belanja();
        $data['belanjas'] = $ModelBelanja->paginate(4, 'belanjas');
        $data['pager'] = $ModelBelanja->pager;
        return view('home', $data);
    }
    public function create()
    {
        return view('create');
    }
    public function store()
    {
        $ModelBelanja = new Belanja();
        
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
        ],
        [
            'username' => [
                'required' => 'Username harus diisi.',
            ],
            'email' => [
                'required' => 'Email harus diisi.',
            ],
            'password' => [
                'required' => 'Password harus diisi.',
            ],
        ]);
        
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga' => $this->request->getPost('harga'),
            'created_at' => date('Y-m-d H:i:s'), // Set nilai timestamp saat ini
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        $ModelBelanja->insert($data);
        
        session()->setFlashdata('success', 'Belanja Berhasil Disimpan');
        
        return redirect()->to(base_url('/'));
    }
    public function edit($id)
    {
        $ModelBelanja = new Belanja();
        $data['belanja'] = $ModelBelanja->find($id);
        return view('edit', $data);
    }
    public function update($id){
        
        $ModelBelanja = new Belanja();
        
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
        ],
        [
            'username' => [
                'required' => 'Username harus diisi.',
            ],
            'email' => [
                'required' => 'Email harus diisi.',
            ],
            'password' => [
                'required' => 'Password harus diisi.',
            ],
        ]);
        
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga' => $this->request->getPost('harga'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        
        $ModelBelanja->update($id, $data);
        
        //flash message
        session()->setFlashdata('success', 'Belanja Berhasil Diupdate');
        
        return redirect()->to(base_url('/'));
        
    }
    public function delete($id){
        $ModelBelanja = new Belanja();
        $data = $ModelBelanja->find($id);
        
        if($data) {
            $ModelBelanja->delete($id);
            
            //flash message
            session()->setFlashdata('success', 'Belanja Berhasil Dihapus');
            
            return redirect()->to(base_url('/'));
        }
        
    }
    public function uploadtransaksi(){
        $databelanja = new Belanja();
        $data['belanjas'] = $databelanja->findAll();
        return view('uploadtransaksi', $data);
    }
    public function storetransaksi(){
        
        
        if (!$this->validate([
            'belanja_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                    ]
                ],
                'file' => [
                    'rules' => 'uploaded[file]|mime_in[file,image/jpg,image/jpeg,image/gif,image/png]|max_size[file,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                        ]
                        
                        ]
                        ])) {
                            session()->setFlashdata('errors', $this->validator->listErrors());
                            return redirect()->back()->withInput();
                        }
                        
                        $berkas = new Uploadtransaksi();
                        $dataBerkas = $this->request->getFile('file');
                        $fileName = $dataBerkas->getRandomName();
                        $berkas->insert([
                            'file' => $fileName,
                            'belanja_id' => $this->request->getPost('belanja_id'),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                        $dataBerkas->move('uploads/transaksi/', $fileName);
                        session()->setFlashdata('success', 'Berkas Berhasil diupload');
                        return redirect()->to('/upload/transaksi');
                    }
                }
                