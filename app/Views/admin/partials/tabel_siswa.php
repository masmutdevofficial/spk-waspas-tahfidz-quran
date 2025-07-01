<table class="table table-bordered text-center">
    <thead class="thead-light">
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Juz</th>
            <th>Kelancaran Membaca</th>
            <th>Waktu</th>
            <th>Tajwid</th>
            <th>Makhrojul Huruf</th>
            <th>Nilai Akhir</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($data as $siswa): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($siswa['nis']) ?></td>
                <td><?= esc($siswa['nama']) ?></td>
                <td><?= esc($siswa['kelas']) ?></td>
                <td><?= esc($siswa['juz']) ?></td>
                <td><?= $siswa['nilai'][1]['nilai'] ?? '-' ?></td>
                <td><?= $siswa['nilai'][2]['nilai'] ?? '-' ?></td>
                <td><?= $siswa['nilai'][3]['nilai'] ?? '-' ?></td>
                <td><?= $siswa['nilai'][4]['nilai'] ?? '-' ?></td>
                <td><?= number_format($siswa['qi'], 2) ?></td>
                <td><?= $siswa['status'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
