<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kinerja Pegawai</title>
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

    <h2 style="text-align: center;">LAPORAN KINERJA PEGAWAI</h2>
    <p style="text-align: center;">Per Tanggal: {{ date('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Pegawai</th>
                <th width="15%">Total Tugas</th>
                <th width="15%">Belum Selesai</th>
                <th width="15%">Sudah Selesai</th>
                <th width="15%">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $user)
            @php
            $unfinished = $user->total_pending + $user->total_process;
            $percent = $user->total_assigned > 0 ? round(($user->total_completed / $user->total_assigned) * 100) : 0;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $user->name }}<br><small style="color:grey">{{ $user->email }}</small></td>
                <td class="text-center">{{ $user->total_assigned }}</td>
                <td class="text-center" style="color:red">{{ $unfinished }}</td>
                <td class="text-center" style="color:green">{{ $user->total_completed }}</td>
                <td class="text-center">{{ $percent }}%</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pegawai.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right; margin-right: 50px;">
        <p>Kota Contoh, {{ date('d F Y') }}</p>
        <p>Kepala Dinas</p>
        <br><br><br>
        <p><strong>(Nama Pimpinan)</strong></p>
    </div>
</body>

</html>