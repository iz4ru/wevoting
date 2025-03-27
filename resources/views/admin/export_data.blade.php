<table>
    <thead>
        <tr>
            <th colspan="6" style="text-align: center; font-weight: bold; font-size: 16px;">
                Data Pemilihan {{ $timestamp }}
            </th>
        </tr>
        <tr>
            <th>Total Pemilih</th>
            <th>Total Kandidat</th>
            <th>Suara Yang Masuk</th>
            <th>Suara Yang Belum Masuk</th>
            <th>Persentase Perolehan Suara</th>
            <th>Persentase Suara yang Belum Masuk</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ isset($voter) ? count($voter) : 0 }}</td>
            <td>{{ isset($candidate) ? count($candidate) : 0 }}</td>
            <td>{{ isset($voteResults) ? count($voteResults) : 0 }}</td>
            <td>{{ isset($voterNotVoted) ? count($voterNotVoted) : 0 }}</td>
            <td>{{ isset($votedPercentage) ? $votedPercentage . '%' : '0%' }}</td>
            <td>{{ isset($notVotedPercentage) ? $notVotedPercentage . '%' : '0%' }}</td>
        </tr>
    </tbody>
</table>
