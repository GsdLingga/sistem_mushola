@extends('layouts.app2')
@section('title', 'Kelola Nilai')
@push('css')
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .modal-dialog{
        max-width: 650px;
    }
    </style>
@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Nilai</h4>

                {{-- <a href="{{route('nilai.create')}}" type="button" class="btn btn-primary waves-effect waves-light" style="color: white;">
                    <i class="mdi mdi-account-plus align-middle mr-2"></i> Tambah Nilai
                </a> --}}
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    <i class="mdi mdi-block-helper mr-2"></i>
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @endforeach
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-block-helper mr-2"></i>
                    {{ session()->get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all mr-2"></i>
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="custom-validation" action="{{ route('nilai.create') }}" method="GET">
                        {{-- @csrf --}}
                        @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Pengurus')
                            <div class="form-group" id="kelasDiv">
                                <label class="control-label">Kelas</label>
                                <select name="kelas" id="selectKelas" class="form-control select2" required>
                                    <option value="">Select</option>
                                    <optgroup label="Kelas">
                                        @foreach ($kelas as $kls)
                                            <option value="{{ $kls->id }}">{{ Str::ucfirst($kls->nama_kelas) }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                @error('mata_pelajaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif
                        <div class="form-group" id="mataPelajaranDiv">
                            <label class="control-label">Mata Pelajaran</label>
                            <select name="mata_pelajaran" id="selectMataPelajaran" class="form-control select2" required>
                                <option value="">Select</option>
                                <optgroup label="Mata Pelajaran">
                                    @foreach ($mata_pelajaran as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->nama_pelajaran }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('mata_pelajaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Tambah Nilai
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        {{-- href="{{route('raport.pdf')}}"  --}}
                        <button type="button" class="btn btn-primary waves-effect waves-light btn-sm" style="color: white;" data-toggle="modal" data-target="#exampleModal">
                            <i class="mdi mdi-account-plus align-middle mr-2"></i> Cetak Raport
                        </button>
                    </div>
                    <h4 class="card-title mb-4">Daftar Nilai Siswa</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Al-Quran</th>
                                <th>Iqro</th>
                                <th>Aqidah Akhlak</th>
                                <th>Hafalan Surat</th>
                                <th>PAI</th>
                                <th>Tajwid</th>
                                <th>Khot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai_all as $nilai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $nilai->nama }}</td>
                                    <td>{{ Str::ucfirst($nilai->nama_kelas) }}</td>
                                    <td>{{ $nilai->{'Al-Quran'} }}</td>
                                    <td>{{ $nilai->{'Iqro'} }}</td>
                                    <td>{{ $nilai->{'Aqidah Akhlak'} }}</td>
                                    <td>{{ $nilai->{'Hafalan Surat'} }}</td>
                                    <td>{{ $nilai->{'PAI'} }}</td>
                                    <td>{{ $nilai->{'Tajwid'} }}</td>
                                    <td>{{ $nilai->{'Khot'} }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cetak Raport</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('nilai.pdf') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Semester</label>
                    <select name="semester" class="form-control" id="selectSemester">
                        <option value="">Pilih Semester</option>
                        @foreach ($semester as $sem)
                            <option value={{$sem->id}}>{{$sem->tahun_ajaran}}</option>
                        @endforeach
                        @error('semester')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </select>
                </div>
                <div class="form-group" id="kelasDiv">
                    <label for="exampleFormControlSelect1">Kelas</label>
                    <select name="kelas" class="form-control" id="selectKelasDialog">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $kls)
                            <option value={{$kls->id}}>{{ucfirst(trans($kls->nama_kelas))}}</option>
                        @endforeach
                        @error('kelas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </select>
                </div>
                <div class="form-group" id="siswaDiv">
                    <label for="exampleFormControlSelect1">Nama Siswa</label>
                    <select name="siswa" class="form-control" id="selectSiswa">
                        {{-- <option value="">Pilih Siswa</option> --}}
                        {{-- @foreach ($siswa as $sis)
                            <option value={{$sis->id}}>{{$sis->nama}}</option>
                        @endforeach --}}
                        @error('siswa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </select>
                </div>
                <div class="form-group">
                    <label>Spiritual</label>
                    <div class="row">
                        <div class="col-4">
                            <input name="spiritual" id="spiritual" type="text" class="form-control" required placeholder="Enter spiritual"/>
                            @error('spiritual')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-8">
                            <input name="spiritual_value" id="spiritual_value" type="text" class="form-control" required placeholder="Enter spiritual value"/>
                            @error('spiritual_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Sosial</label>
                    <div class="row">
                        <div class="col-4">
                            <input name="sosial" id="sosial" type="text" class="form-control" required placeholder="Enter sosial"/>
                            @error('sosial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-8">
                            <input name="sosial_value" id="sosial_value" type="text" class="form-control" required placeholder="Enter sosial value"/>
                            @error('sosial_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Catatan</label>
                    <div>
                        <input name="catatan" id="catatan" type="text" class="form-control" required placeholder="Enter catatan"/>
                        @error('catatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer" id="btnDiv">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                  <button id="btnSubmit" type="submit" class="btn btn-primary" style="float: right;">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

@endsection
@push('js')
    <!-- Buttons examples -->
    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

    <script src="{{asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>
    <script>
        let semester = document.getElementById('selectSemester');
        let kelas = document.getElementById('selectKelasDialog');
        let siswa = document.getElementById('selectSiswa');
        let kelasDiv = document.getElementById('kelasDiv')
        let siswaDiv = document.getElementById('siswaDiv')
        let btnDiv = document.getElementById('btnDiv')
        let spiritual = document.getElementById('spiritual')
        let sosial = document.getElementById('sosial')
        let catatan = document.getElementById('catatan')

        $('#selectKelasDialog, #selectSemester').change(function(){
            let semesterValue = semester.value;
            let kelasValue = kelas.value;
            // console.log(semesterValue)
            // console.log(kelasValue)
            $.ajax({
                type: "GET",
                url: "api/getSiswaOptions",
                data: {
                    semesterValue,
                    kelasValue,
                },
                success: function (response) {
                    removeOptions(siswa);
                    $('#selectSiswa').append($('<option>', {value: '', text: 'Select Siswa'}));
                    for (let index = 0; index < response.length; index++) {
                        // console.log(response[index])
                        $('#selectSiswa').append($('<option>', {value: response[index].id, text: response[index].nama}));
                    }
                },
                error: function (e) {
                    console.log(e);
                },
            });
        })

        $('#btnSubmit').click(function(){
            if (semester.value === "" || kelas.value === "" || siswa.value === "" || spiritual.value === "" || sosial.value === "" || catatan.value === "") {
                alert("There is an empty input")
            }else{
                let semesterValue = semester.value
                let kelasValue = kelas.value
                let siswaValue = siswa.value
                let spiritualValue = spiritual.value
                let sosialValue = sosial.value
                let catatanValue = catatan.value
                $.ajax({
                    type: "POST",
                    url: "/create-pdf-file",
                    data: { "_token": "{{ csrf_token() }}",
                    semesterValue, kelasValue, siswaValue, spiritualValue, sosialValue, catatanValue },
                    success: function (response) {
                        console.log(response)
                    },
                    error: function (e) {
                        console.log(e)
                    },
                });
            }
        })

        function removeOptions(selectElement) {
            var i, L = selectElement.options.length - 1;
            for(i = L; i >= 0; i--) {
                selectElement.remove(i);
            }
        }
    </script>
@endpush
