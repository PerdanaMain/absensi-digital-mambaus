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
    <h1>Data Matpel</h1>
    <table>
        <thead>
            <tr>
                <th>ID Matpel</th>
                <th>Nama Matpel</th>
                <th>Nama Guru</th>
                <th>Kelas</th>
                <th>Tipe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matpel as $index => $matpel)
                <tr>
                    <td>{{ $matpel->matpelId }}</td>
                    <td>{{ $matpel->name }}</td>
                    <td>{{ $matpel->guru->name }}</td>
                    <td>{{ $matpel->kelas->name }}</td>
                    <td>{{ $matpel->type->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
