<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Laporan Data Barang</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barang as $index => $b): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $b->nama_barang; ?></td>
                <td><?php echo $b->kode_barang; ?></td>
                <td><?php echo $b->jumlah; ?></td>
                <td><?php echo $b->kondisi; ?></td>
                <td><?php echo $b->lokasi; ?></td>
                <td><?php echo $b->tanggal_input; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
