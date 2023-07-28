<?php

namespace App\Controllers;
use App\Models\Belanja;
use CodeIgniter\Validation\Rules;


class Home extends BaseController
{
    public function index()
    {
        $ModelBelanja = new Belanja();
        $data['belanjas'] = $ModelBelanja->findAll();
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
}
