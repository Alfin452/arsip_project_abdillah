<table>
    <thead>
        <tr>
            <th style="background-color: #FFFF00; font-weight: bold; border: 1px solid #000000;">No</th>
            <th style="background-color: #FFFF00; font-weight: bold; border: 1px solid #000000;">No. Agenda</th>
            <th style="background-color: #FFFF00; font-weight: bold; border: 1px solid #000000;">No. Surat</th>
            <th style="background-color: #FFFF00; font-weight: bold; border: 1px solid #000000;">Tgl. Surat</th>
            <th style="background-color: #FFFF00; font-weight: bold; border: 1px solid #000000;">Tgl. Diterima</th>
            <th style="background-color: #FFFF00; font-weight: bold; border: 1px solid #000000;">Asal Instansi</th>
            <th style="background-color: #FFFF00; font-weight: bold; border: 1px solid #000000;">Perihal</th>
            <th style="background-color: #FFFF00; font-weight: bold; border: 1px solid #000000;">Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach($letters as $index => $letter)
        <tr>
            <td style="border: 1px solid #000000;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #000000;">{{ $letter->agenda_number }}</td>
            <td style="border: 1px solid #000000;">{{ $letter->reference_number }}</td>
            <td style="border: 1px solid #000000;">{{ $letter->letter_date->format('d/m/Y') }}</td>
            <td style="border: 1px solid #000000;">{{ $letter->received_date->format('d/m/Y') }}</td>
            <td style="border: 1px solid #000000;">{{ $letter->origin }}</td>
            <td style="border: 1px solid #000000;">{{ $letter->description }}</td>
            <td style="border: 1px solid #000000;">{{ $letter->category->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>