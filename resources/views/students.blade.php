<!DOCTYPE html>
<html>

<head>
    <title>Data Mahasiswa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            Data Mahasiswa
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

    <thead class="table-dark">

        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Minat</th>
            <th>Nilai</th>
            <th>Preferensi Karir</th>
            <th>Aksi</th>
        </tr>

    </thead>

    <tbody>

        @foreach($students as $student)

        <tr>

            <td>{{ $student->nim }}</td>

            <td>{{ $student->nama }}</td>

            <td>

                @foreach($student->interests as $interest)

                    <span class="badge bg-primary">
                        {{ $interest->name }}
                    </span>

                @endforeach

            </td>

            <td>

                @php

                    $avg = $student->grades
                        ->map(function ($g) {

                            return match($g->grade) {

                                'A' => 100,
                                'A-' => 90,
                                'B+' => 85,
                                'B' => 80,
                                default => 70
                            };
                        })
                        ->avg();

                @endphp

                {{ round($avg,2) }}

            </td>

            <td>
                {{ $student->career_preference }}
            </td>

            <td>

                <a
                    href="{{ url('/recommend/'.$student->id) }}"
                    class="btn btn-success btn-sm">

                    Lihat Rekomendasi

                </a>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

        </div>

    </div>

</div>

</body>

</html>