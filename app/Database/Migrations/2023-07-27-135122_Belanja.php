<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Belanja extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'jumlah'      => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'harga'      => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ]);
        
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('belanja');
    }
    
    public function down()
    {
        $this->forge->dropTable('belanja');
    }
}
