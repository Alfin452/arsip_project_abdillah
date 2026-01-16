<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Surat Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
            width: 100%;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
            margin-right: 50px;
        }

        @media print {
            @page {
                size: landscape;
                margin: 1cm;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <h1>PEMERINTAH KOTA CONTOH</h1>
        <h1>DINAS ARSIP DAN PERPUSTAKAAN</h1>
        <p>Jl. Merdeka No. 45, Kota Contoh, Telp: (021) 555-9999</p>
    </div>

    <h2 style="text-align: center;">AGENDA SURAT MASUK</h2>
    <p style="text-align: center;">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">No. Agenda</th>
                <th width="15%">No. Surat</th>
                <th width="12%">Tgl. Surat</th>
                <th width="12%">Diterima</th>
                <th width="20%">Asal Instansi</th>
                <th>Perihal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->agenda_number }}</td>
                <td>{{ $item->reference_number }}</td>
                <td class="text-center">{{ $item->letter_date->format('d/m/Y') }}</td>
                <td class="text-center">{{ $item->received_date->format('d/m/Y') }}</td>
                <td>{{ $item->origin }}</td>
                <td>{{ $item->description }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature">
        <div class="signature-box">
            <p>Kota Contoh, {{ date('d F Y') }}</p>
            <p>Mengetahui, Kepala Dinas</p>
            <br><br><br>
            <p><strong>(Nama Pimpinan)</strong></p>
            <p>NIP. 19800101 200001 1 001</p>
        </div>
    </div>
</body>

</html>