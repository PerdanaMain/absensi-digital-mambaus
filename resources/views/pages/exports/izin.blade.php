<!-- resources/views/users/pdf.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Data Laporan Perizinan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .photo img {
            max-width: 50px;
            max-height: 50px;
        }
    </style>
</head>

<body>
    <h1>Data Laporan Perizinan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Alasan Izin</th>
                <th>Tanggal Keluar</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Nama Pengurus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $key => $p)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $p->santri->name }}</td>
                    <td>{{ $p->description }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $p->tglKeluar)->locale('id-ID')->translatedFormat('d F Y') }}
                    </td>
                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $p->tglKembali)->locale('id-ID')->translatedFormat('d F Y') }}
                    </td>
                    <td>
                        @if ($p->isComback)
                            <span class="badge rounded-pill bg-success">Sudah Kembali</span>
                        @else
                            <span class="badge rounded-pill bg-warning">Belum Kembali</span>
                        @endif
                    </td>
                    </td>
                    <td>{{ $p->santri->pengurus->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
