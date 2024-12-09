<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $useAutoIncrement = false; // Set to false since id_transaksi is not auto-increment
    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id_transaksi',
        'id_karyawan',
        'id_pelanggan',
        'kode_voucher',
        'harga_total',
        'pembayaran',
        'kembalian'
    ];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Modifikasi INNER JOIN menjadi LEFT JOIN pada tabel menu
    public function getTransactionDetail($id)
    {
        return $this->select('
        transaksi.id_transaksi,
        transaksi.created_at as tanggal_transaksi,
        transaksi.pembayaran as pembayaran_transaksi,
        transaksi.harga_total as total_transaksi,
        transaksi.kode_voucher,
        transaksi.kembalian as kembalian_transaksi,
        karyawan.nama_karyawan,
        pelanggan.nama_pelanggan,
        detailtransaksi.id_menu,
        detailtransaksi.nama_menu,
        detailtransaksi.jumlah_produk,
        detailtransaksi.harga_satuan,
        detailtransaksi.harga_total as subtotal,
        kodevoucher.diskon
    ')
            ->join('karyawan', 'karyawan.id_karyawan = transaksi.id_karyawan')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->join('detailtransaksi', 'detailtransaksi.id_transaksi = transaksi.id_transaksi')
            // Tidak perlu join ke tabel menu lagi
            ->join('kodevoucher', 'kodevoucher.kode_voucher = transaksi.kode_voucher', 'left')
            ->where('transaksi.id_transaksi', $id)
            ->findAll();
    }

    public function getTransaksiWithRelations()
    {
        return $this->select('transaksi.*, karyawan.nama_karyawan, pelanggan.nama_pelanggan')
            ->join('karyawan', 'karyawan.id_karyawan = transaksi.id_karyawan')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->findAll();
    }

    public function getDetailTransaksi($id)
    {
        return $this->select('transaksi.*, karyawan.nama_karyawan, pelanggan.nama_pelanggan, voucher.jumlah_poin')
            ->join('karyawan', 'karyawan.id_karyawan = transaksi.id_karyawan')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->join('voucher', 'voucher.kode_voucher = transaksi.kode_voucher', 'left')
            ->where('transaksi.id_transaksi', $id)
            ->first();
    }

    // app/Models/TransaksiModel.php

    public function getLaporanPenjualan($start_date = null, $end_date = null)
    {
        $builder = $this->select('transaksi.id_transaksi, transaksi.created_at as tanggal, pelanggan.nama_pelanggan, SUM(detailtransaksi.jumlah_produk) as total_barang, SUM(detailtransaksi.harga_total) as total_belanja')
            ->join('detailtransaksi', 'detailtransaksi.id_transaksi = transaksi.id_transaksi')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->groupBy('transaksi.id_transaksi');

        if ($start_date && $end_date) {
            $builder->where('DATE(transaksi.created_at) >=', $start_date);
            $builder->where('DATE(transaksi.created_at) <=', $end_date);
        }

        return $builder->findAll();
    }

    public function getDetailTransaksiById($id_transaksi)
    {
        return $this->select('transaksi.*, pelanggan.nama_pelanggan')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->where('transaksi.id_transaksi', $id_transaksi)
            ->first();
    }

    public function getDetailTransaksiItems($id_transaksi)
    {
        return $this->db->table('detailtransaksi')
            ->select('detailtransaksi.*, menu.nama_menu')
            ->join('menu', 'menu.id_menu = detailtransaksi.id_menu')
            ->where('detailtransaksi.id_transaksi', $id_transaksi)
            ->get()->getResultArray();
    }

    public function generateIdTransaksi()
    {
        $lastEntry = $this->orderBy('id_transaksi', 'DESC')->first();

        if ($lastEntry) {
            $lastIdNumber = intval(substr($lastEntry['id_transaksi'], 3));
            $newIdNumber = $lastIdNumber + 1;
        } else {
            $newIdNumber = 1;
        }

        return 'TRX' . str_pad($newIdNumber, 7, '0', STR_PAD_LEFT);
    }

    public function getTransaksiByVoucher($kode_voucher)
    {
        return $this->select('transaksi.*, pelanggan.nama_pelanggan, karyawan.nama_karyawan')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->join('karyawan', 'karyawan.id_karyawan = transaksi.id_karyawan')
            ->where('transaksi.kode_voucher', $kode_voucher)
            ->findAll();
    }
}