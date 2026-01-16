<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi Kategori</title>
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
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        @media print {
            @page {
                size: portrait;
                margin: 1.5cm;
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

    <h2 style="text-align: center;">REKAPITULASI ARSIP PER KATEGORI</h2>
    <p style="text-align: center;">Dicetak pada: {{ date('d F Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Kategori</th>
                <th width="15%">Surat Masuk</th>
                <th width="15%">Surat Keluar</th>
                <th width="15%">Total Arsip</th>
            </tr>
        </thead>
        <tbody>
            @php $totalIn = 0; $totalOut = 0; @endphp
            @forelse($data as $index => $item)
            @php
            $totalIn += $item->incoming_letters_count;
            $totalOut += $item->outgoing_letters_count;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->name }} ({{ $item->code }})</td>
                <td class="text-center">{{ $item->incoming_letters_count }}</td>
                <td class="text-center">{{ $item->outgoing_letters_count }}</td>
                <td class="text-center"><b>{{ $item->incoming_letters_count + $item->outgoing_letters_count }}</b></td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada kategori.</td>
            </tr>
            @endforelse
            <tr style="background-color: #eee; font-weight: bold;">
                <td colspan="2" class="text-center">TOTAL KESELURUHAN</td>
                <td class="text-center">{{ $totalIn }}</td>
                <td class="text-center">{{ $totalOut }}</td>
                <td class="text-center">{{ $totalIn + $totalOut }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <div class="signature-box">
            <p>Kota Contoh, {{ date('d F Y') }}</p>
            <p>Petugas Arsip</p>
            <br><br><br>
            <p><strong>{{ Auth::user()->name }}</strong></p>
        </div>
    </div>
</body>

</html>