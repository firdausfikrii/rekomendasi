<!DOCTYPE html>
<html>
<head>
    <title>Input Rekomendasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header">
            Input Data Mahasiswa
        </div>

        <div class="card-body">

            <form action="/recommend" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Nama Mahasiswa</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">

                    <label>Minat</label>

                    <select
                        name="interest"
                        class="form-select">

                        <option>Rekayasa Perangkat Lunak</option>
<option>Kecerdasan Buatan & Data</option>
<option>Jaringan & Keamanan Siber</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Nilai Rata-rata</label>

                    <input
                        type="is_float"
                        name="grade"
                        class="form-control"
                        min="0"
                        max="100">

                </div>

                <div class="mb-3">

                    <label>Preferensi Bidang</label>

                    <select
                        name="career"
                        class="form-select">


    <option>Software Engineer</option>
    <option>Mobile Developer</option>
    <option>Game Developer</option>

    <option>Data Scientist</option>
    <option>AI Engineer</option>

    <option>Cyber Security Analyst</option>
    <option>Cloud Engineer</option>

                    </select>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Generate Rekomendasi

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>