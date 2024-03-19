<!DOCTYPE html>
<html>

<head>
    <title>Data PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

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
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Lanskap */
        @page {
            size: 15cm 8cm;
            /* Perubahan lebar dan tinggi sesuai lanskap */
            margin: 0;
        }

        body {
            margin: 0.5cm;
        }

        /* Atur ukuran gambar logo */
        .logo {
            width: 100px;
            height: 100px;
        }

        /* Atur ukuran gambar QR Code */
        .qrcode {
            width: 150px;
            height: 150px;
        }
    </style>
</head>

<body>
    <table style="width:100%; margin-top: 10px;" class="table table-bordered">
        <tr>
            <td rowspan="2">
                <img src="{{ asset('assets/img/logo_samara.png') }}" alt="Logo ISTW" class="logo">
            </td>
            <td>Kode Barang</td>
            <td>BARCODE</td>
        </tr>
        <tr>
            <td>
                {{ $barang->kode_barang }}
            </td>
            <td rowspan="4">
                <img src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code" class="qrcode">
            </td>
        </tr>
        <tr>
            <td>PT. Samara</td>
            <td>CUSTOMER</td>
        </tr>
        <tr>
            <td>QTY PETI</td>
            <td rowspan="2">PT. {{ $barang->nama_barang }}</td>
        </tr>
        <tr>
            <td>1</td>
        </tr>
    </table>

</body>

</html>
