<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Qualified Personnel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        td {
            border: 1px solid;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        .highlight {
            background-color: #8dd5ed;
        }

        .header th {
            border: 1px solid;
            padding: 2px;
            background-color: #8fcbdf
        }

        #logo {
            text-align: left;
            padding: 5px;
        }

        .persegi {
            width: 10px;
            /* Lebar persegi */
            height: 10px;
            /* Tinggi persegi */
            background-color: yellow;
            /* Warna kuning */
            border: 1px solid black;
            padding-left: 10px
        }

        /* .data {
            height: 100px;
        } */
    </style>
</head>

<body>
    <table style="width: 100%">
        <thead>
            <tr
                style="
                        height: 80px;
                        border: 1px solid;
                        padding: 8px;
                    ">
                <th id="logo" colspan="2">
                    <img src="{{ public_path('sb-admin/assets/img/logo-dankos.png') }}" alt="Logo Dankos"
                        style="width: 80px" />

                </th>
                <th style="text-align: center; padding-top:10px; padding-left:40px" colspan="5">
                    LIST OF QUALIFIED PERSONNEL ENTERING <br> STERILE AND ASEPTIC FACILITY {{ $line }}
                    <p>Effective Date:................</p>
                </th>
                <th style="text-align: center;" colspan="2">


                </th>
            </tr>
        </thead>
        <thead>
            <tr class="header">
                <th style="size: 10px;">No</th>
                <th>Employee Number</th>
                <th style="width:20%">Name</th>
                <th>Department</th>
                <th style="width: 12%">Sterile Re-qualification Date</th>
                <th>Sterile Qualification Status</th>
                <th style="width: 13%">Aseptic Re-qualification Date</th>
                <th>Aseptic Qualification Status</th>
                <th>Qualified for Grade</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $karyawan)
                @php
                    $rekualifikasiDate = $karyawan->kualifikasiTeori->tanggal_rekualifikasi; // Ambil dari kualifikasiTeori
                    $isExpiring = false;

                    if ($rekualifikasiDate) {
                        $date = \Carbon\Carbon::parse($rekualifikasiDate);
                        $now = \Carbon\Carbon::now();
                        $twoMonthsLater = $now->copy()->addMonths(2);

                        $isExpiring = $date->between($now, $twoMonthsLater);
                    }
                @endphp
                <tr @if ($isExpiring) style="background-color: yellow;" @endif>
                    <td class="data">{{ $loop->iteration }}</td>
                    <td>{{ $karyawan->nik }}</td>
                    <td>{{ $karyawan->name }}</td>
                    <td>{{ $karyawan->departemen }}</td>
                    <td>
                        {{ $rekualifikasiDate ? $date->format('d M Y') : 'NOT QUALIFIED' }}
                    </td>
                    <td>{{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'rekualifikasi'))->hasil ?? 'NOT QUALIFIED' }}
                    </td>
                    <td>
                        {{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis'))->tanggal_rekualifikasi
                            ? \Carbon\Carbon::parse(
                                optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis'))->tanggal_rekualifikasi,
                            )->format('d M Y')
                            : 'NOT QUALIFIED' }}
                    </td>
                    <td>{{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis'))->hasil ?? 'NOT QUALIFIED' }}
                    </td>
                    <td>GRADE B & C</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data untuk ditampilkan.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot style="
        height: 80px;
        border: 1px solid;
        padding: 2px;">
            <tr>
                <th></th>
                <th colspan="8">
                    <p style="text-align: left; font-size:10px; margin:0%; padding-top:5px">Note : *) QUALIFIED / NOT
                        QUALIFIED</p>
                </th>
            </tr>
            <tr>
                <th>
                    <p class="persegi" style="margin-left: 2px; margin-top:3px ">
                    </p>
                </th>
                <th colspan="8">
                    <p style="text-align: left; font-size:9.7px; margin-top:0%">
                        Qualification period
                        will expire soon. Personnel is
                        suggested to register for re-training or
                        gowning re-qualification.
                    </p>


                </th>
            </tr>
            <tr>
                <th colspan="7"></th>
                <th style="text-align: center;" colspan="2">
                    <hr style="width: 100px;">

                    <p style="">QA Line Manager</p>
                </th>
            </tr>

        </tfoot>
    </table>
</body>

</html>
