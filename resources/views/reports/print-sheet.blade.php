<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lembar Disposisi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .container {
            border: 2px solid black;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            border-bottom: 2px double black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .row {
            display: flex;
            border-bottom: 1px solid black;
            padding: 10px 0;
        }

        .col {
            flex: 1;
            padding: 0 10px;
        }

        .label {
            font-weight: bold;
            width: 150px;
            display: inline-block;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin: 10px 0;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        @media print {
            @page {
                size: portrait;
                margin: 2cm;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container">
        <div class="header">
            <h1>PEMERINTAH KOTA CONTOH</h1>
            <h1>DINAS ARSIP DAN PERPUSTAKAAN</h1>
            <p>Jl. Merdeka No. 45, Kota Contoh</p>
        </div>

        <div class="title">LEMBAR DISPOSISI</div>

        <div class="row">
            <div class="col"><span class="label">Surat Dari</span>: {{ $letter->origin }}</div>
            <div class="col"><span class="label">Diterima Tgl</span>: {{ $letter->received_date->format('d M Y') }}</div>
        </div>
        <div class="row">
            <div class="col"><span class="label">No. Surat</span>: {{ $letter->reference_number }}</div>
            <div class="col"><span class="label">No. Agenda</span>: {{ $letter->agenda_number }}</div>
        </div>
        <div class="row">
            <div class="col"><span class="label">Tgl. Surat</span>: {{ $letter->letter_date->format('d M Y') }}</div>
            <div class="col"><span class="label">Sifat</span>: {{ $letter->category->name }}</div>
        </div>
        <div class="row" style="border-bottom: 2px solid black;">
            <div class="col"><span class="label">Perihal</span>: {{ $letter->description }}</div>
        </div>

        <p style="font-weight: bold; margin-top: 20px;">DITERUSKAN KEPADA:</p>

        <table>
            <thead>
                <tr>
                    <th>Nama Staff / Pejabat</th>
                    <th>Instruksi / Catatan</th>
                    <th>Batas Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($letter->dispositions as $disp)
                <tr>
                    <td>{{ $disp->user->name }}</td>
                    <td>{{ $disp->note }}</td>
                    <td>{{ $disp->due_date->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; padding: 20px;">- Belum ada instruksi disposisi -</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 50px; text-align: right;">
            <p>Kepala Dinas,</p>
            <br><br><br>
            <p>( ..................................................... )</p>
        </div>
    </div>

</body>

</html>