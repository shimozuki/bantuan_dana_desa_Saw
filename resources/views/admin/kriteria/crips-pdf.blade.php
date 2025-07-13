<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Penilaian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .garis1 {
            border-top: 3px solid black;
            height: 2px;
            border-bottom: 1px solid black;
        }

        table.custom-table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            font-size: 14px;
        }

        table.custom-table th,
        table.custom-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        table.custom-table thead th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .judul-header {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- Kop Surat --}}
        <table style="width: 100%;">
            <tr>
                <td style="padding-right: 20px; padding-left: 20px; width: 100px;">
                    <img src="{{ public_path('logo.png') }}" width="80" height="80">
                </td>
                <td style="text-align: center;">
                    <h5 style="margin: 0; font-size: 18px;">PEMERINTAH KABUPATEN SUMBAWA</h5>
                    <h5 style="margin: 0; font-size: 17px;">KECAMATAN LAPE</h5>
                    <h5 style="margin: 0; font-size: 17px;">KANTOR KEPALA DESA LAPE</h5>
                    <p style="margin: 2px 0; font-style: italic; font-size: 14px;">
                        Jalan Pendidikan Nomor 01 Desa Lape
                    </p>
                </td>
            </tr>
        </table>

        <hr class="garis1" />
        <div class="judul-header">LIST PENILAIAN</div>

        {{-- Tabel Dinamis --}}
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Crips / Sub Kriteria</th>
                    <th>Bobot</th>

                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($crips as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->nama_crips }}</td>
                    <td>{{ $row->bobot }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- TTD Kepala Desa --}}
        <div class="mt-5" style="text-align: right;">
            <p>Sumbawa, {{ $tanggal }}</p>
            <p><strong>KEPALA DESA LAPE</strong></p>
            <br><br>
            <p><strong><u>Rodianto S.kom. M.kom</u></strong><br>
                NIP. 3175044408730004</p>
        </div>
    </div>
</body>

</html>