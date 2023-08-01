<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Uploadtransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'belanja_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'file' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => true, // Set default value to null
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'null' => true, // Set default value to null
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('belanja_id', 'belanja', 'id');
        $this->forge->createTable('uploadtransaksi');
    }

    public function down()
    {
        $this->forge->dropTable('uploadtransaksi');
    }
}
