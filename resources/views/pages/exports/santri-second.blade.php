<!-- resources/views/users/pdf.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Data Santri</title>

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
    <h1>Data Santri</h1>
    <table>
        <thead>
            <tr>
                <th>ID Santri</th>
                <th>Nama Santri</th>
                <th>Age</th>
                <th>Nama Wali</th>
                <th>Nama Pengurus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($santri as $index => $santri)
                <tr>
                    <td>{{ $santri->santriId }}</td>
                    <td>{{ $santri->name }}</td>
                    <td>{{ $santri->age }}</td>
                    <td>{{ $santri->wali->name }}</td>
                    <td>{{ $santri->pengurus->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
