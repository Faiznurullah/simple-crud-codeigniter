<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory as Faker;


class BelanjaSeeder extends Seeder
{
    public function run()
    {

        $data = [
            [
                'nama' => 'apel',
                'jumlah' => 10,
                'harga' => 10000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'jeruk',
                'jumlah' => 16,
                'harga' => 16000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'coklat',
                'jumlah' => 11,
                'harga' => 19000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
         
        $this->db->table('belanja')->insertBatch($data);
    }
}
