<table>
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
                Status Vote
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($voters as $voter)
            <tr>
                <td>
                    {{ $voter->user_id }}</td>
                <td>
                    {{ $voter->name }}</td>
                <td>
                    {{ $voter->class }}</td>
                <td>
                    {{ $voter->vocation }}</td>
                <td>
                    {{ $voter->access_code }}</td>
                <td>
                    {{ ucwords($voter->validation) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
