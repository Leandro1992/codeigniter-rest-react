<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DatabaseCreator extends Migration
{
	public function up()
	{
		$forge = $this->forge;
		$forge->createDatabase('codeigniter', TRUE);
		$forge = \Config\Database::forge('codeigniter', TRUE);

		$fields = [
			'id' => [
					'type'           => 'INT',
					'constraint'     => 10,
					'unsigned'       => true,
					'auto_increment' => true
			],
			'name' => [
					'type'           => 'VARCHAR',
					'constraint'     => '100',
			],
			'password' => [
					'type'           =>'VARCHAR',
					'constraint'     => 100,
			],
			'deleted_at' => [
				'type'           =>'TIMESTAMP'
			]
		];
		$forge->addField($fields);
		$forge->addPrimaryKey('id');
		$forge->createTable('login', TRUE);
		$forge->addColumn('login', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('login');
	}
}
