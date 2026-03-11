<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCatalogTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 120],
            'category' => ['type' => 'VARCHAR', 'constraint' => 50],
            'portion' => ['type' => 'VARCHAR', 'constraint' => 30],
            'base_price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'touch_color' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => '#f59e0b'],
            'active' => ['type' => 'INTEGER', 'constraint' => 1, 'default' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');

        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 120],
            'description' => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'active' => ['type' => 'INTEGER', 'constraint' => 1, 'default' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('menus');

        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true],
            'menu_id' => ['type' => 'INTEGER'],
            'product_id' => ['type' => 'INTEGER'],
            'variant_name' => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'quantity' => ['type' => 'INTEGER', 'default' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('menu_id', 'menus', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('menu_items');

        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 120],
            'description' => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true],
            'combo_price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'active' => ['type' => 'INTEGER', 'constraint' => 1, 'default' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('combos');

        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true],
            'combo_id' => ['type' => 'INTEGER'],
            'product_id' => ['type' => 'INTEGER'],
            'quantity' => ['type' => 'INTEGER', 'default' => 1],
            'price_delta' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('combo_id', 'combos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('combo_items');
    }

    public function down()
    {
        $this->forge->dropTable('combo_items', true);
        $this->forge->dropTable('combos', true);
        $this->forge->dropTable('menu_items', true);
        $this->forge->dropTable('menus', true);
        $this->forge->dropTable('products', true);
    }
}
