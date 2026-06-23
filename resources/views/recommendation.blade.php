<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rekomendasi Mata Kuliah PCR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">

        <div class="text-center mb-4">
            <h1 class="fw-bold">
                Sistem Rekomendasi Mata Kuliah Pilihan
            </h1>

            <p class="text-muted">
                Berbasis Relasi dan Kombinatorika
            </p>
        </div>

        <!-- HASIL TERBAIK -->

        <div class="card shadow-sm border-success mb-4">
            <div class="card-header bg-success text-white">
                Hasil Rekomendasi Terbaik
            </div>

            <div class="card-body">

                <h3 class="text-success">
                    {{ $results[0]['course'] }}
                </h3>

                <p>
                    Skor :
                    <strong>{{ $results[0]['score'] }}</strong>
                </p>

            </div>
        </div>

        <!-- SCORING -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">
                Tabel Scoring Mata Kuliah
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Bidang</th>
                            <th>Minat</th>
                            <th>Nilai</th>
                            <th>Preferensi</th>
                            <th>Total</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($results as $row)

                        <tr>

                            <td>{{ $row['course'] }}</td>

                            <td>{{ $row['bidang'] }}</td>

                            <td>{{ $row['interest_score'] }}</td>

                            <td>{{ $row['grade_score'] }}</td>

                            <td>{{ $row['career_score'] }}</td>

                            <td>
                                <strong>
                                    {{ $row['score'] }}
                                </strong>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>

        <!-- KOMBINATORIKA -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">
                Kombinasi Mata Kuliah Terbaik
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>

                        <tr>
                            <th>Ranking</th>
                            <th>Kombinasi</th>
                            <th>Total Skor</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($bestPackages as $index => $package)

                        <tr>

                            <td>{{ $index + 1 }}</td>

                            <td>{{ $package['package'] }}</td>

                            <td>{{ $package['score'] }}</td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        <!-- DECISION TREE -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">
                Pohon Keputusan
            </div>

            <div class="card-body">

                <pre class="mb-0">
Apakah Minat Sesuai?
│
├── Ya
│   │
│   ├── Nilai > 80 ?
│   │   │
│   │   ├── Ya
│   │   │   │
│   │   │   ├── Preferensi Karir Sesuai?
│   │   │   │   │
│   │   │   │   ├── Ya
│   │   │   │   │
│   │   │   │   └── {{ $decisionTree['hasil'] }}
│   │   │
│   │   └── Tidak
│   │
│   └── Alternatif
│
└── Tidak
    │
    └── Bidang Lain
</pre>

            </div>

        </div>

        <!-- ANALISIS -->

        <div class="card shadow-sm">

            <div class="card-header">
                Analisis Rekomendasi
            </div>

            <div class="card-body">

                <p>

                    Sistem merekomendasikan

                    <strong>
                        {{ $bestPackages[0]['package'] }}
                    </strong>

                    karena memiliki total skor tertinggi berdasarkan:

                </p>

                <ul>

                    <li>Kesesuaian minat mahasiswa</li>

                    <li>Nilai akademik mahasiswa</li>

                    <li>Preferensi bidang karir</li>

                    <li>Hasil kombinatorika seluruh alternatif</li>

                </ul>

            </div>

        </div>

    </div>

</body>

</html>