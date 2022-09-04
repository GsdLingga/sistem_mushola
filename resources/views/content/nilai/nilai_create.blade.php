@extends('layouts.app2')
@section('title', 'Tambah Nilai Siswa')
@push('css')
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Nilai</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Raport</a></li>
                        <li class="breadcrumb-item active">Tambah Nilai</li>
                    </ol>
                </div>

            </div>
        </div>
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
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Nilai</h4>
                    <p class="card-title-desc">
                    </p>
                    <form class="custom-validation" action="{{ route('nilai.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Kelas</label>
                            <div>
                                <input name="kelas_id" id="kelas_id" type="text" class="form-control" required value="{{$kelas->id}}" hidden/>
                                <input name="kelas" id="kelas" type="text" class="form-control" required value="{{Str::ucfirst($kelas->nama_kelas)}}" disabled/>
                                @error('kelas_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <div>
                                <input name="mata_pelajaran_id" id="mata_pelajaran_id" type="text" class="form-control" required value="{{$mata_pelajaran->id}}" hidden/>
                                <input name="mata_pelajaran" id="mata_pelajaran" type="text" class="form-control" required value="{{$mata_pelajaran->nama_pelajaran}}" disabled/>
                                @error('mata_pelajaran_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai_kelas as $anggota)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $anggota->nama }}</td>
                                        <td>
                                            <div>
                                                <input name="id[]" id="id" data-parsley-type="number" type="text" class="form-control" required value="{{$anggota->id}}" hidden/>
                                            </div>
                                            <div>
                                                <input name="id_nilai[]" id="id_nilai" data-parsley-type="number" type="text" class="form-control" value="{{$anggota->id_nilai}}" hidden/>
                                            </div>
                                            <div>
                                                <input name="nilai[]" id="nilai" data-parsley-type="number" type="text" class="form-control" required value="{{$anggota->nilai}}" placeholder="Enter only numbers"/>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-group mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@push('js')
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>

    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

    {{-- <script>
        let mataPelajaran = document.getElementById('selectMataPelajaran');
        let mataPelajaranDiv = document.getElementById('mataPelajaranDiv')

        $('#selectMataPelajaran').change(function(){
            let mataPelajaranValue = mataPelajaran.value;
            console.log(mataPelajaranValue);
            $.ajax({
                type: "GET",
                url: "/api/getNilaiCreate",
                data: {
                    mataPelajaranValue,
                },
                success: function (response) {
                    console.log(response)
                    // removeOptions(siswa);
                    // $('#selectSiswa').append($('<option>', {value: '', text: 'Select Siswa'}));
                    // for (let index = 0; index < response.length; index++) {
                    //     // console.log(response[index])
                    //     $('#selectSiswa').append($('<option>', {value: response[index].id, text: response[index].nama}));
                    // }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                },
            })
        })
    </script> --}}
@endpush
