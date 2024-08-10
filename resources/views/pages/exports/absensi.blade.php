<!-- resources/views/users/pdf.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Data Absensi</title>

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
    <h1>Data Absensi</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Santri</th>
                <th>Nama Matpel</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensi as $index => $absensi)
                <tr>
                    <td>{{ $absensi->santri->name }}</td>
                    <td>{{ $absensi->description != null ? $absensi->description : $absensi->matpel->name . ' - ' . $absensi->matpel->kelas->name }}
                    </td>
                    <td>{{ $absensi->date }}</td>
                    <td>{{ $absensi->status->name }}</td>
                    <td>{{ $absensi->type->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
