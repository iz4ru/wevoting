<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print PDF</title>
</head>
<body>
    <table class="w-max" border="1" cellpadding="5" cellspacing="">
    <thead>
        <tr>
            <th>
                No Identitas
            </th>
            <th>
                Nama
            </th>
            <th>
                Kelas
            </th>
            <th>
                Jurusan / Bidang
            </th>
            <th>
                Kode
                Akses
            </th>
            <th>
                Validasi
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>
                    {{ $item->user_id }}</td>
                <td>
                    {{ $item->name }}</td>
                <td>
                    {{ $item->class }}</td>
                <td>
                    {{ $item->vocation }}</td>
                <td>
                    {{ $item->access_code }}</td>
                <td>
                    {{ ucwords($item->validation) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>

