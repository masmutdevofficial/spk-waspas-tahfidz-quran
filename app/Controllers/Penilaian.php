<?php

namespace App\Controllers;

use App\Models\NilaiSiswaModel;
use App\Models\SiswaModel;
use App\Models\KriteriaModel;
use App\Models\HasilPenilaianModel;

class Penilaian extends BaseController
{
    public function index()
    {
        $nilaiSiswa = new NilaiSiswaModel();
        $siswa      = new SiswaModel();
        $kriteria   = new KriteriaModel();
    
        // Ambil semua id siswa yang sudah punya nilai
        $siswaNilai = $nilaiSiswa
            ->distinct()
            ->select('id_siswa')
            ->findColumn('id_siswa');
    
        // Tampilkan hanya siswa yang belum ada di nilai_siswa
        $data['siswa'] = $siswaNilai
            ? $siswa->whereNotIn('id', $siswaNilai)->findAll()
            : $siswa->findAll();
    
        $data['kriteria'] = $kriteria->findAll();
    
        // Tampilkan semua nilai jika diperlukan
        $data['nilai'] = $nilaiSiswa
            ->select('nilai_siswa.*, siswa.nama_siswa, kriteria.nama_kriteria')
            ->join('siswa', 'siswa.id = nilai_siswa.id_siswa')
            ->join('kriteria', 'kriteria.id = nilai_siswa.id_kriteria')
            ->orderBy('id_siswa')
            ->findAll();

        // Ambil data nilai siswa yang dikelompokkan per siswa
        $nilaiData = $nilaiSiswa
            ->select('nilai_siswa.*, siswa.nama_siswa, kriteria.nama_kriteria')
            ->join('siswa', 'siswa.id = nilai_siswa.id_siswa')
            ->join('kriteria', 'kriteria.id = nilai_siswa.id_kriteria')
            ->orderBy('id_siswa')
            ->findAll();

        $data['kriteria'] = $kriteria->findAll();

        // Kelompokkan nilai per siswa
        $grouped = [];
        foreach ($nilaiData as $n) {
            $grouped[$n['id_siswa']]['nama_siswa'] = $n['nama_siswa'];
            $grouped[$n['id_siswa']]['nilai'][$n['id_kriteria']] = $n;
        }

        $data['nilai_siswa'] = $grouped;
    
        return view('admin/penilaian', $data);
    }

    public function tambah()
    {
        $model = new NilaiSiswaModel();
        $data  = $this->request->getPost();
        $idSiswa = $data['id_siswa'];
    
        foreach ($data['nilai'] as $idKriteria => $nilai) {
            $model->save([
                'id_siswa'    => $idSiswa,
                'id_kriteria' => $idKriteria,
                'nilai'       => $nilai,
            ]);
        }
    
        return redirect()->to('/penilaian')->with('success', 'Semua nilai berhasil disimpan');
    }

    public function update($id_siswa)
    {
        $model = new NilaiSiswaModel();
        $data  = $this->request->getPost();
    
        foreach ($data['nilai'] as $id_kriteria => $nilai) {
            // Update berdasarkan kombinasi id_siswa dan id_kriteria
            $model->where('id_siswa', $id_siswa)
                  ->where('id_kriteria', $id_kriteria)
                  ->set(['nilai' => $nilai])
                  ->update();
        }
    
        return redirect()->to('/penilaian')->with('success', 'Nilai berhasil diperbarui');
    }

    public function delete($id_siswa)
    {
        $model = new NilaiSiswaModel();
        $model->where('id_siswa', $id_siswa)->delete();
    
        return redirect()->to('/penilaian')->with('success', 'Semua nilai siswa berhasil dihapus');
    }

    public function algoritmaWaspas()
    {
        $model = new NilaiSiswaModel();
    
        // Ambil data lengkap dari nilai_siswa
        $data = $model
            ->select('nilai_siswa.*, siswa.nama_siswa, kriteria.id as id_kriteria, kriteria.nama_kriteria')
            ->join('siswa', 'siswa.id = nilai_siswa.id_siswa')
            ->join('kriteria', 'kriteria.id = nilai_siswa.id_kriteria')
            ->whereIn('kriteria.id', [1, 2, 3, 4])
            ->orderBy('nilai_siswa.id_siswa')
            ->findAll();
    
        // Fungsi konversi nilai
        function konversi($id_kriteria, $nilai)
        {
            switch ($id_kriteria) {
                case 1:
                case 3:
                case 4:
                    if ($nilai <= 2) return 1.00;
                    if ($nilai >= 3 && $nilai <= 5) return 0.80;
                    if ($nilai >= 6 && $nilai <= 10) return 0.60;
                    if ($nilai >= 11 && $nilai <= 15) return 0.40;
                    if ($nilai > 15) return 0.20;
                    break;
    
                case 2:
                    if ($nilai <= 35) return 1.00;
                    if ($nilai >= 36 && $nilai <= 40) return 0.80;
                    if ($nilai >= 41 && $nilai <= 45) return 0.60;
                    if ($nilai >= 46 && $nilai <= 50) return 0.40;
                    if ($nilai > 50) return 0.20;
                    break;
            }
            return null;
        }
    
        // Strukturkan data per siswa
        $siswaData = [];
        $namaKriteria = [];
    
        foreach ($data as $row) {
            $idSiswa = $row['id_siswa'];
            $idKriteria = $row['id_kriteria'];
            $konversi = konversi($idKriteria, $row['nilai']);
    
            $siswaData[$idSiswa]['nama'] = $row['nama_siswa'];
            $siswaData[$idSiswa]['nilai'][$idKriteria] = [
                'asli' => $row['nilai'],
                'konversi' => $konversi
            ];
    
            // Simpan nama kriteria hanya sekali
            if (!isset($namaKriteria[$idKriteria])) {
                $namaKriteria[$idKriteria] = $row['nama_kriteria'];
            }
        }
    
        // Urutkan kolom kriteria 1-4
        ksort($namaKriteria);
    
        // Cetak tabel
        echo "<h3>Konversi Bobot</h3>";
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<thead>
                <tr>
                    <th>Nama Siswa</th>";
        foreach ($namaKriteria as $id => $nama) {
            echo "<th>$nama</th>";
        }
        echo "</tr>
            </thead><tbody>";
    
        foreach ($siswaData as $siswa) {
            echo "<tr><td>{$siswa['nama']}</td>";
    
            foreach ($namaKriteria as $id => $nama) {
                if (isset($siswa['nilai'][$id])) {
                    $nilaiAsli = $siswa['nilai'][$id]['asli'];
                    $konversi  = $siswa['nilai'][$id]['konversi'];
                    echo "<td>{$konversi}</td>";
                } else {
                    echo "<td>-</td>";
                }
            }
    
            echo "</tr>";
        }
    
        echo "</tbody></table>";

        // 1. Ambil semua nilai konversi per kriteria
        $nilaiPerKriteria = [];

        foreach ($siswaData as $siswa) {
            foreach ($siswa['nilai'] as $idKriteria => $n) {
                $nilaiPerKriteria[$idKriteria][] = $n['konversi'];
            }
        }

        // 2. Hitung Max dan Min per kriteria
        $max = [];
        $min = [];

        foreach ($nilaiPerKriteria as $idKriteria => $values) {
            $max[$idKriteria] = max($values);
            $min[$idKriteria] = min($values);
        }

        // 3. Normalisasi sesuai jenis kriteria
        $normalisasi = [];

        foreach ($siswaData as $idSiswa => $siswa) {
            foreach ($siswa['nilai'] as $idKriteria => $n) {
                $konv = $n['konversi'];

                // Jenis kriteria (hardcoded sementara, atau bisa pakai query)
                $jenis = in_array($idKriteria, [1, 2]) ? 'benefit' : 'cost';

                if ($jenis === 'benefit') {
                    $norm = $konv / $max[$idKriteria];
                } else {
                    $norm = $min[$idKriteria] / $konv;
                }

                $siswaData[$idSiswa]['nilai'][$idKriteria]['normalisasi'] = round($norm, 4);
            }
        }

        echo "<h3>Normalisasi Nilai</h3>";
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<thead><tr><th>Nama Siswa</th>";
        foreach ($namaKriteria as $id => $nama) {
            echo "<th>{$nama}</th>";
        }
        echo "</tr></thead><tbody>";

        foreach ($siswaData as $siswa) {
            echo "<tr><td>{$siswa['nama']}</td>";
            foreach ($namaKriteria as $id => $nama) {
                if (isset($siswa['nilai'][$id])) {
                    $val = $siswa['nilai'][$id];
                    $norm = $val['normalisasi'];
                    echo "<td><strong>{$norm}</strong></td>";
                } else {
                    echo "<td>-</td>";
                }
            }
            echo "</tr>";
        }

        echo "</tbody></table>";

        // 4. Ambil bobot tiap kriteria dari DB
        $db = \Config\Database::connect();
        $kriteriaRows = $db->table('kriteria')
            ->select('id, bobot')
            ->whereIn('id', array_keys($namaKriteria))
            ->get()->getResultArray();

        $bobot = [];
        foreach ($kriteriaRows as $row) {
            $bobot[$row['id']] = floatval($row['bobot']);
        }

        // 5. Hitung WSM, WPM, dan Qi
        foreach ($siswaData as $idSiswa => &$siswa) {
            $WSM = 0;
            $WPM = 1;

            foreach ($namaKriteria as $idKriteria => $nama) {
                $norm = $siswa['nilai'][$idKriteria]['normalisasi'] ?? 0;
                $bobotKriteria = $bobot[$idKriteria] ?? 0;

                $WSM += $norm * $bobotKriteria;
                $WPM *= pow($norm, $bobotKriteria);
            }

            $siswa['WSM'] = round($WSM, 4);
            $siswa['WPM'] = round($WPM, 4);
            $siswa['Qi']  = round((0.5 * $WSM) + (0.5 * $WPM), 4);
        }

        // 6. Tambahkan status kelulusan berdasarkan Qi
        foreach ($siswaData as &$siswa) {
            $qi = $siswa['Qi'];
            $siswa['status_kelulusan'] = ($qi >= 0.6) ? 'Lulus' : 'Tidak Lulus';
        }

        echo "<h3>Nilai Akhir Dan Status Kelulusan</h3>";
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>WSM</th>
                    <th>WPM</th>
                    <th>Qi</th>
                    <th>Status Kelulusan</th>
                </tr>
              </thead><tbody>";
        
        foreach ($siswaData as $siswa) {
            echo "<tr>
                    <td>{$siswa['nama']}</td>
                    <td>{$siswa['WSM']}</td>
                    <td>{$siswa['WPM']}</td>
                    <td><strong>{$siswa['Qi']}</strong></td>
                    <td><strong>{$siswa['status_kelulusan']}</strong></td>
                  </tr>";
        }
        
        echo "</tbody></table>";

        // Inisialisasi model
        $hasilModel = new HasilPenilaianModel();

        foreach ($siswaData as $idSiswa => $siswa) {
            $dataToSave = [
                'id_siswa'         => $idSiswa,
                'nilai_wsm'        => $siswa['WSM'],
                'nilai_wpm'        => $siswa['WPM'],
                'nilai_qi'         => $siswa['Qi'],
                'status_kelulusan' => $siswa['status_kelulusan'],
            ];

            // Cek apakah data sudah ada
            $existing = $hasilModel->where('id_siswa', $idSiswa)->first();

            if ($existing) {
                // Update
                $hasilModel->update($existing['id'], $dataToSave);
            } else {
                // Insert
                $hasilModel->insert($dataToSave);
            }
        }
    }
}
