<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultSeeder extends Seeder
{
    public function run()
    {
        // 1. Seeder Users    
        $users = [
            [
                'nama'       => 'Admin',
                'email'      => 'admin@gmail.com',
                'password'   => password_hash('admin', PASSWORD_DEFAULT),
                'role'       => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Guru Penguji 1',
                'email'      => 'gurupenguji1@gmail.com',
                'password'   => password_hash('gurupenguji1', PASSWORD_DEFAULT),
                'role'       => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Guru Penguji 2',
                'email'      => 'gurupenguji2@gmail.com',
                'password'   => password_hash('gurupenguji2', PASSWORD_DEFAULT),
                'role'       => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('users')->insertBatch($users);


        // 2. Seeder Periode
        $periodeData = [
            ['tahun' => '2023', 'semester' => 'Ganjil'],
            ['tahun' => '2023', 'semester' => 'Genap'],
            ['tahun' => '2024', 'semester' => 'Ganjil'],
            ['tahun' => '2024', 'semester' => 'Genap'],
            ['tahun' => '2025', 'semester' => 'Ganjil'],
            ['tahun' => '2025', 'semester' => 'Genap'],
        ];
        foreach ($periodeData as $row) {
            $this->db->table('periode')->insert($row);
        }

        // 3. Seeder Kriteria
        $kriteriaData = [
            [
                'nama_kriteria' => 'Kelancaran Membaca',
                'jenis'         => 'benefit',
                'bobot'         => 0.40,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Waktu',
                'jenis'         => 'benefit',
                'bobot'         => 0.30,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Tajwid',
                'jenis'         => 'cost',
                'bobot'         => 0.15,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Makhrojul Huruf',
                'jenis'         => 'cost',
                'bobot'         => 0.15,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('kriteria')->insertBatch($kriteriaData);

        // 4. Seeder Siswa dan Seeder Nilai Siswa
        $siswaList = [
            ['nama_siswa' => 'Fauzan Alwan', 'jenis_kelamin' => 'L'],
            ['nama_siswa' => 'Indra Jaya',   'jenis_kelamin' => 'L'],
            ['nama_siswa' => 'Maulidya',     'jenis_kelamin' => 'P'],
            ['nama_siswa' => 'Miftah',       'jenis_kelamin' => 'P'],
            ['nama_siswa' => 'Shamil',       'jenis_kelamin' => 'P'],
        ];

        $nilaiPerKriteria = [
            1 => [15, 5, 10, 10, 4], // Kelancaran Membaca
            2 => [38, 21, 54, 40, 42], // Waktu
            3 => [6, 5, 7, 5, 3], // Tajwid
            4 => [9, 2, 2, 5, 5], // Makhrojul Huruf
        ];

        $faker = \Faker\Factory::create('id_ID');
        $periode = $this->db->table('periode')->get()->getResultArray();
        $periodeIDs = array_column($periode, 'id');

        foreach ($siswaList as $index => $siswa) {
            // Insert siswa
            $this->db->table('siswa')->insert([
                'id_periode'    => $faker->randomElement($periodeIDs),
                'id_user'       => $faker->randomElement([2, 3]),
                'nama_siswa'    => $siswa['nama_siswa'],
                'jenis_kelamin' => $siswa['jenis_kelamin'],
                'tgl_lahir'     => $faker->dateTimeBetween('2008-01-01', '2015-12-31')->format('Y-m-d'),
                'kelas'         => 'Kelas ' . $faker->randomDigitNotNull(),
                'juz'           => 'Juz ' . $faker->numberBetween(1, 30),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        
            $idSiswa = $this->db->insertID();
        
            // Masukkan nilai per kriteria dari array manual
            foreach ($nilaiPerKriteria as $idKriteria => $nilaiArray) {
                $this->db->table('nilai_siswa')->insert([
                    'id_siswa'    => $idSiswa,
                    'id_kriteria' => $idKriteria,
                    'nilai'       => $nilaiArray[$index],
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
