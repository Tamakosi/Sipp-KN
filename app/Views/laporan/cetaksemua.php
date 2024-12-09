<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <style>
        /* Style untuk cetak */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        h2, h3 {
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">
    <h2>Laporan Penjualan</h2>
    <?php if ($start_date && $end_date): ?>
        <p>Periode: <?= date('d-m-Y', strtotime($start_date)) ?> s/d <?= date('d-m-Y', strtotime($end_date)) ?></p>
    <?php else: ?>
        <p>Periode: Semua</p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total Barang</th>
                <th>Total Belanja (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $totalPenjualan = 0;
            foreach ($laporan as $row):
                $totalPenjualan += $row['total_belanja'];
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                <td><?= $row['nama_pelanggan']; ?></td>
                <td><?= $row['total_barang']; ?></td>
                <td><?= number_format($row['total_belanja'], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total Penjualan</th>
                <th>Rp <?= number_format($totalPenjualan, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>