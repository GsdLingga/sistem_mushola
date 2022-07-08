<!DOCTYPE html>
<html>
<head>
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

    </style>
</head>
<body style="background-image: url({{ storage_path('app/public/pdf/latar.jpeg') }}); background-repeat: no-repeat; background-size: auto; background-size: 100% 100%;">
    <div style="margin: 80px 50px 0 80px">
        <img src="{{ storage_path('app/public/pdf/header.png') }}" style="width: 100%">

        <table class="table-font" style="width:100%;">
            <tr>
                <td style="width: 25%">Nama Musholla</td>
                <td style="width: 40%">: Jabal Rahmah</td>
                <td style="width: 15%">Kelas</td>
                <td style="width: 10%">:</td>
            </tr>
            <tr>
                <td style="width: 25%">Alamat</td>
                <td style="width: 40%">:</td>
                <td style="width: 15%">Semester</td>
                <td style="width: 10%">:</td>
            </tr>
            <tr>
                <td style="width: 25%">Nama Peserta Didik</td>
                <td style="width: 40%">:</td>
                <td style="width: 15%">Tahun Pelajaran</td>
                <td style="width: 10%">:</td>
            </tr>
            <tr>
                <td style="width: 25%">No. Induk</td>
                <td style="width: 40%">:</td>
                <td style="width: 15%"></td>
                <td style="width: 10%"></td>
            </tr>
        </table>

        <table class="table table-font" style="width:100%;">
            <tr>
                <td colspan="2" style="width: 100%">A. ASPEK KEPRIBADIAN</td>
            </tr>
            <tr>
                <td style="width: 25%">1. SPIRITUAL</td>
                <td style="width: 75%; text-align:center;">DESKRIPSI</td>
            </tr>
            <tr >
                <td class="blank_row" style="width: 25%"></td>
                <td style="width: 75%"> </td>
            </tr>
            <tr>
                <td style="width: 25%">2. SOSIAL</td>
                <td style="width: 75%; text-align:center;">DESKRIPSI</td>
            </tr>
            <tr>
                <td class="blank_row" style="width: 25%"> </td>
                <td style="width: 75%"> </td>
            </tr>
        </table>

        <table class="table table-font" style="width:100%;">
            <tr>
                <td rowspan="2" style="width: 33%">B. PENGETAHUAN</td>
                <td colspan="2" style="width: 33%; text-align:center;"> NILAI</td>
            </tr>
            <tr>
                <td  style="width: 33%; text-align:center;">PRESTASI</td>
                <td  style="width: 33%; text-align:center;">RATA-RATA</td>
            </tr>
            <tr>
                <td style="width: 33%">1. AL'QUR'AN</td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td style="width: 33%">2. IQRO'</td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td style="width: 33%">3. AQIDAH AKHLAQ</td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td style="width: 33%">4.HAFALAN SURAT</td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td style="width: 33%">5.PAI</td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td style="width: 33%">6. TAJWID</td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td style="width: 33%">7. KHOT</td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td class="blank_row" style="width: 33%"></td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td style="width: 33%">RATA-RATA</td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td style="width: 33%"></td>
                <td style="width: 33%">SAKIT</td>
                <td style="width: 33%">hari</td>
            </tr>
            <tr>
                <td style="width: 33%">JUMLAH HADIR KARENA</td>
                <td style="width: 33%">IZIN</td>
                <td style="width: 33%">hari</td>
            </tr>
            <tr>
                <td style="width: 33%"></td>
                <td style="width: 33%">ALPA</td>
                <td style="width: 33%">hari</td>
            </tr>
            <tr>
                <td class="blank_row" style="width: 33%"></td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td style="width: 33%">RANKING</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td style="width: 33%">CATATAN</td>
                <td colspan="2"></td>
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
