<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Himpunan dan Relasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <!-- HEADER -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">
                Sistem Rekomendasi Mata Kuliah Pilihan PCR
            </h1>
        </div>

        <!-- HIMPUNAN -->
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-primary text-white">
                Himpunan Mahasiswa (M)
            </div>

            <div class="card-body">

                <div class="row">

                    @foreach($students as $student)

                    <div class="col-md-4 mb-3">

                        <div class="card border-primary">

                            <div class="card-body text-center">

                                <h5 class="mb-0">
                                    {{ $student->nama }}
                                </h5>

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

        <!-- NOTASI HIMPUNAN -->
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-success text-white">
                Notasi Himpunan
            </div>

            <div class="card-body">

                <h5>
                    M =
                    {
                    @foreach($students as $student)
                    {{ $student->nama }}@if(!$loop->last), @endif
                    @endforeach
                    }
                </h5>

            </div>

        </div>

        <!-- HIMPUNAN MINAT -->

<div class="card shadow-sm mb-4">

    <div class="card-header bg-info text-white">
        Himpunan Minat (I)
    </div>

    <div class="card-body">

        <div class="row">

            @php
                $allInterests = $students
                    ->flatMap(fn($s) => $s->interests)
                    ->unique('id');
            @endphp

            @foreach($allInterests as $interest)

            <div class="col-md-4 mb-3">

                <div class="card border-info">

                    <div class="card-body text-center">

                        <h6 class="mb-0">
                            {{ $interest->name }}
                        </h6>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

<!-- NOTASI HIMPUNAN MINAT -->

<div class="card shadow-sm mb-4">

    <div class="card-header bg-secondary text-white">
        Notasi Himpunan Minat
    </div>

    <div class="card-body">

        <h5>

            I = {

            @foreach($allInterests as $interest)

                {{ $interest->name }}

                @if(!$loop->last)
                    ,
                @endif

            @endforeach

            }

        </h5>

    </div>

</div>

        <!-- RELASI -->
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-dark text-white">
                Tabel Relasi Mahasiswa - Minat
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Minat</th>
                        </tr>

                    </thead>

                    <tbody>

                        @php $no = 1; @endphp

                        @foreach($students as $student)

                        @foreach($student->interests as $interest)

                        <tr>

                            <td>{{ $no++ }}</td>

                            <td>{{ $student->nama }}</td>

                            <td>

                                <span class="badge bg-primary">
                                    {{ $interest->name }}
                                </span>

                            </td>

                        </tr>

                        @endforeach

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        <!-- NOTASI RELASI -->
        <div class="card shadow-sm">

            <div class="card-header bg-warning">
                Notasi Relasi (R)
            </div>

            <div class="card-body">

                <pre class="mb-0">
R = {
@foreach($students as $student)
@foreach($student->interests as $interest)
({{ $student->nama }}, {{ $interest->name }})
@endforeach
@endforeach
}
                </pre>

            </div>

        </div>

    </div>

</body>

</html>