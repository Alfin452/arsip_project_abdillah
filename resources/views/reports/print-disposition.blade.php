<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Monitoring Disposisi</title>
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

        .status-pending {
            background-color: #fef9c3;
        }

        .status-processed {
            background-color: #dbeafe;
        }

        .status-completed {
            background-color: #dcfce7;
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

    <h2 style="text-align: center;">LAPORAN MONITORING DISPOSISI</h2>
    <p style="text-align: center;">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Surat Masuk (Asal)</th>
                <th width="25%">Instruksi</th>
                <th width="15%">Penerima Tugas</th>
                <th width="12%">Batas Waktu</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <b>{{ $item->incomingLetter->origin ?? '-' }}</b><br>
                    <small>No: {{ $item->incomingLetter->reference_number ?? '-' }}</small>
                </td>
                <td>{{ $item->note }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td class="text-center">{{ $item->due_date->format('d/m/Y') }}</td>
                <td class="text-center status-{{ $item->status }}">
                    {{ ucfirst($item->status) }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data.</td>
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