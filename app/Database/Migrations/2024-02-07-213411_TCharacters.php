<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TCharacters extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_character' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '1000',
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_character', true);
        $this->forge->createTable('t_characters');
    }

    public function down()
    {
        $this->forge->dropTable('t_characters');
    }
}