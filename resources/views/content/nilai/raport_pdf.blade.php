<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport</title>
    <style>
        .table,
        .table tr,
        .table td {
            border: 2px solid black;
            border-collapse: collapse;
        }

        .blank_row{
            height: 18px !important; /* overwrites any other rules */
            background-color: #FFFFFF;
        }

        .table-font{
            font-size: 10pt;
        }

        .ttd{
            display: flex;
            justify-content: space-between;
        }
        p{
            margin: 0;
        }
        .bold{
            font-weight: bold
        }
        .text-center{
            text-align: center
        }

    </style>
</head>
<body style="background-image: url({{ $image_latar }}); background-repeat: no-repeat; background-size: auto; background-size: 100% 100%;">
    <div style="margin: 80px 50px 0 80px">
        <img src="{{$image_header}}" style="width: 100%">

        <table class="table-font" style="width:100%;">
            <tr>
                <td class="bold" style="width: 25%;">Nama Musholla</td>
                <td style="width: 35%">: Jabal Rahmah</td>
                <td class="bold" style="width: 15%">Kelas</td>
                <td style="width: 15%">: {{$kelas}}</td>
            </tr>
            <tr>
                <td class="bold" style="width: 25%">Alamat</td>
                <td style="width: 35%">: {{$siswa->alamat}}</td>
                <td class="bold" style="width: 15%">Semester</td>
                <td style="width: 15%">: {{$semester}}</td>
            </tr>
            <tr>
                <td class="bold" style="width: 25%">Nama Peserta Didik</td>
                <td style="width: 35%">: {{$siswa->nama}}</td>
                <td class="bold" style="width: 15%">Tahun Pelajaran</td>
                <td style="width: 15%">: {{$tahun_pelajaran}}</td>
            </tr>
            <tr>
                <td class="bold" style="width: 25%">No. Induk</td>
                <td style="width: 35%">: {{$siswa->no_induk}}</td>
                <td style="width: 15%"></td>
                <td style="width: 15%"></td>
            </tr>
        </table>

        <table class="table table-font" style="width:100%;">
            <tr>
                <td colspan="2" class="bold" style="width: 100%;">A. ASPEK KEPRIBADIAN</td>
            </tr>
            <tr>
                <td class="bold" style="width: 25%;">1. SPIRITUAL</td>
                <td class="bold text-center" style="width: 75%;">DESKRIPSI</td>
            </tr>
            <tr >
                <td style="width: 25%"> {{$spiritual['title']}} </td>
                <td style="width: 75%"> {{$spiritual['description']}} </td>
            </tr>
            <tr>
                <td class="bold" style="width: 25%;">2. SOSIAL</td>
                <td class="bold text-center" style="width: 75%;">DESKRIPSI</td>
            </tr>
            <tr>
                <td style="width: 25%"> {{$sosial['title']}} </td>
                <td style="width: 75%"> {{$sosial['description']}} </td>
            </tr>
        </table>

        <table class="table table-font" style="width:100%;">
            <tr>
                <td rowspan="2" class="bold" style="width: 33%;">B. PENGETAHUAN</td>
                <td colspan="2" class="bold text-center" style="width: 33%;"> NILAI</td>
            </tr>
            <tr>
                <td  style="width: 33%; text-align:center;">PRESTASI</td>
                <td  style="width: 33%; text-align:center;">RATA-RATA</td>
            </tr>
            @foreach ($mata_pelajaran as $mapel)
                <tr>
                    <td style="width: 33%;">{{ $loop->iteration }}. {{$mapel->nama_pelajaran}}</td>
                    @if (!empty($nilai[$mapel->nama_pelajaran]))
                        <td style="width: 33%; text-align:center">{{$nilai[$mapel->nama_pelajaran]}}</td>
                    @else
                    <td style="width: 33%; text-align:center">0</td>
                    @endif
                    <td style="width: 33%; text-align:center">{{number_format((float)$rata_rata[$mapel->nama_pelajaran], 1, '.', '')}}</td>
                </tr>
            @endforeach
            <tr>
                <td class="blank_row" style="width: 33%"></td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td style="width: 33%;">RATA-RATA</td>
                <td style="width: 33%; text-align:center">{{number_format((float)$nilai['rata-rata'], 1, '.', '')}}</td>
                <td style="width: 33%; text-align:center">{{number_format((float)$rata_rata['rata-rata'], 1, '.', '')}}</td>
            </tr>
            <tr>
                <td style="width: 33%"></td>
                <td style="width: 33%">SAKIT</td>
                <td style="width: 33%">{{$kehadiran['sakit']}} hari</td>
            </tr>
            <tr>
                <td style="width: 33%;">JUMLAH HADIR KARENA</td>
                <td style="width: 33%">IZIN</td>
                <td style="width: 33%">{{$kehadiran['izin']}} hari</td>
            </tr>
            <tr>
                <td style="width: 33%"></td>
                <td style="width: 33%">ALPA</td>
                <td style="width: 33%">{{$kehadiran['alpa']}} hari</td>
            </tr>
            <tr>
                <td class="blank_row" style="width: 33%"></td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            @if (!empty($ranking->rank))
                <tr>
                    <td style="width: 33%;">RANKING</td>
                    <td colspan="2">{{$ranking->rank}}</td>
                </tr>
            @else
            <tr>
                <td style="width: 33%;">RANKING</td>
                <td colspan="2">{{$ranking}}</td>
            </tr>
            @endif
            <tr>
                <td style="width: 33%;">CATATAN</td>
                <td colspan="2"> {{$catatan}} </td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="width: 33%">
                    <div>
                        <p>Mengetahui :</p>
                        <p>Orang Tua / Wali Santri</p>
                        <p style="height: 50px"></p>
                        <p>(....................................)</p>
                    </div>
                </td>
                <td style="width: 33%"></td>
                <td style="width: 33%;">
                    <div style="float: right">
                        <p>Mumbul, .......................</p>
                        <p>Wali Kelas,</p>
                        <p style="height: 50px"></p>
                        <p>(....................................)</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 33%">
                </td>
                <td style="width: 33%; text-align: center">
                    <div>
                        <p>Mengetahui</p>
                        <p>Kepala TPQ Jabal Rahmah</p>
                        <p style="height: 50px"></p>
                        <p>(....................................)</p>
                    </div>
                </td>
                <td style="width: 33%"></td>
            </tr>
        </table>
    </div>
</body>
</html>
