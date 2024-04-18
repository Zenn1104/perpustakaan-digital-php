<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN PEMINJAMAN BUKU</title>
    <style>
        /* Style umum untuk layar */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }

        /* Style untuk mencetak */
        @media print {
            body {
                font-size: 12px;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                border: 1px solid #000;
                text-align: center;
                padding: 6px;
            }
            th {
                background-color: #f2f2f2;
            }
        }
        
        /* Style untuk tanda tangan */
        .tanda-tangan {
            margin-top: 50px;
            text-align: center;
        }
        .tanda-tangan .left, .tanda-tangan .right {
            display: inline-block;
            width: 45%;
            text-align: left;
            float: left, right;
        }
        .tanda-tangan .right {
            float: right;
            width: 30%;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;"><?= $model['title'] ?? 'Laporan Peminjaman Buku' ?></h1><br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($model['datas'] as $peminjaman) { ?>
                <tr>
                    <th scope="row"><?php echo $no++; ?></th>
                    <td><?php echo $peminjaman->username; ?></td>
                    <td><?php echo $peminjaman->title; ?></td>
                    <td><?php echo date("Y-m-d", strtotime($peminjaman->tanggalPeminjaman)); ?></td>
                    <td><?php echo date("Y-m-d", strtotime($peminjaman->tanggalPengembalian)); ?></td>
                    <td><?php echo $peminjaman->statusPeminjaman; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Tanda tangan kepala sekolah dan kepala perpustakaan -->
    <div class="tanda-tangan">
        <div class="left">
            <p>Mengetahui,</p>
            <p>Kepala SMKS MUHAMMADIYAH SENGKANG </p><br><br>
            <p>Dra. Hj. MULIYATI M.SI</p>
            <p>NIP.19000000000000000</p>
        </div>
        <div class="right">
            <p>Sengkang, <?php echo date('d F Y'); ?></p>
            <p>Kepala Perpustakaan </p><br><br>
            <p>Andi Rohana, S.Pd</p>
            <p>NIP. 156789655009</p>
        </div>
    </div>

    <script>
        // Otomatis tampilkan dialog pencetakan saat halaman dimuat
        window.print();
    </script>
</body>
</html>
