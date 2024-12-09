<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <style>
        /* Tambahkan CSS cetak jika diperlukan */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        h2,
        h3 {
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">
    <h2>Detail Transaksi</h2>
    <table>
        <tr>
            <th>ID Transaksi</th>
            <td><?= $transaksi['id_transaksi'] ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td><?= date('d-m-Y H:i:s', strtotime($transaksi['tanggal_transaksi'])) ?></td>
        </tr>
        <tr>
            <th>Pelanggan</th>
            <td><?= $transaksi['nama_pelanggan'] ?></td>
        </tr>
        <tr>
            <th>Karyawan</th>
            <td><?= $transaksi['nama_karyawan'] ?></td>
        </tr>
    </table>

    <h3>Detail Item</h3>
    <table>
        <tr>
            <th>Nama Menu</th>
            <th>Jumlah</th>
            <th>Harga Satuan (Rp)</th>
            <th>Subtotal (Rp)</th>
        </tr>
        <?php $total = 0;
        foreach ($detail_transaksi as $item): ?>
            <tr>
                <td><?= $item['nama_menu'] ?></td>
                <td><?= $item['jumlah_produk'] ?></td>
                <td><?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                <td><?= number_format($item['subtotal'], 0, ',', '.') ?></td>
            </tr>
            <?php $total += $item['subtotal']; endforeach; ?>
    </table>

    <h3>Ringkasan Transaksi</h3>
    <table>
        <tr>
            <th>Total Harga Sebelum Diskon</th>
            <td>Rp <?= number_format($total, 0, ',', '.') ?></td>
        </tr>
        <?php if ($transaksi['kode_voucher']): ?>
            <tr>
                <th>Diskon (Voucher <?= $transaksi['kode_voucher'] ?>)</th>
                <td>Rp <?= number_format($total - $transaksi['total_transaksi'], 0, ',', '.') ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <th>Total Harga Setelah Diskon</th>
            <td>Rp <?= number_format($transaksi['total_transaksi'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Pembayaran</th>
            <td>Rp <?= number_format($transaksi['pembayaran_transaksi'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Kembalian</th>
            <td>Rp <?= number_format($transaksi['kembalian_transaksi'], 0, ',', '.') ?></td>
        </tr>
    </table>
</body>

</html>