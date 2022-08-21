@extends('layouts.app2')
@section('title', 'Edit Nilai')
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Siswa</a></li>
                        <li class="breadcrumb-item active">Edit Siswa</li>
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
                    <h4 class="card-title">Edit Nilai</h4>
                    <p class="card-title-desc">
                    </p>
                    <form class="custom-validation" action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label>Kelas</label>
                            <div>
                                <input name="kelas" id="kelas" type="text" class="form-control" required value="{{Str::ucfirst($nilai->nama_kelas)}}" disabled/>
                                @error('kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <div>
                                <input name="mata_pelajaran" id="mata_pelajaran" type="text" class="form-control" required value="{{$nilai->nama_pelajaran}}" disabled/>
                                @error('mata_pelajaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Siswa</label>
                            <div>
                                <input name="nama" id="nama" value="{{ $nilai->nama }}" type="text" class="form-control" required disabled/>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nilai</label>
                            <div>
                                <input name="nilai" id="nilai" value="{{ $nilai->nilai }}" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                @error('nilai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Update
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
@endpush
