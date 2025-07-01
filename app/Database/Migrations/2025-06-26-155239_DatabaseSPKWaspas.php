<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DatabaseSPKWaspas extends Migration
{
    public function up()
    {
        // TABEL USERS
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'role'       => ['type' => 'TINYINT', 'comment' => '1=Admin, 2=Guru Penguji'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // TABEL PERIODE
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'tahun'      => ['type' => 'VARCHAR', 'constraint' => 5],
            'semester'   => ['type' => 'ENUM', 'constraint' => ['Ganjil', 'Genap'], 'default' => 'Ganjil'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('periode');

        // TABEL KRITERIA
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nama_kriteria'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis'          => ['type' => 'ENUM', 'constraint' => ['cost', 'benefit'], 'default' => 'benefit'],
            'bobot'          => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kriteria');

        // TABEL SISWA
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_periode'    => ['type' => 'INT', 'unsigned' => true],
            'id_user'       => ['type' => 'INT', 'unsigned' => true],
            'nis'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'nama_siswa'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis_kelamin' => ['type' => 'ENUM', 'constraint' => ['L', 'P'], 'default' => 'L'],
            'tgl_lahir'     => ['type' => 'DATE'],
            'kelas'         => ['type' => 'VARCHAR', 'constraint' => 50],
            'juz'           => ['type' => 'VARCHAR', 'constraint' => 50],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_periode', 'periode', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('siswa');

        // TABEL NILAI_SISWA
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_siswa'    => ['type' => 'INT', 'unsigned' => true],
            'id_kriteria' => ['type' => 'INT', 'unsigned' => true],
            'nilai'       => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kriteria', 'kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('nilai_siswa');

        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_siswa'    => ['type' => 'INT', 'unsigned' => true],
            'id_kriteria' => ['type' => 'INT', 'unsigned' => true],
            'nilai'       => ['type' => 'DECIMAL', 'constraint' => '10,4'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kriteria', 'kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('nilai_konversi');

        // TABEL NILAI_WASPAS
        $this->forge->addField([
            'id'                 => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_siswa'           => ['type' => 'INT', 'unsigned' => true],
            'nilai_wsm'          => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'nilai_wpm'          => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'nilai_qi'           => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'status_kelulusan'   => ['type' => 'ENUM', 'constraint' => ['Lulus', 'Tidak Lulus'], 'default' => 'Tidak Lulus'],
            'created_at'         => ['type' => 'DATETIME', 'null' => true],
            'updated_at'         => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('nilai_waspas');
    }

    public function down()
    {
        $this->forge->dropTable('users');
        $this->forge->dropTable('nilai_waspas');
        $this->forge->dropTable('nilai_siswa');
        $this->forge->dropTable('siswa');
        $this->forge->dropTable('kriteria');
        $this->forge->dropTable('periode');
    }
}
