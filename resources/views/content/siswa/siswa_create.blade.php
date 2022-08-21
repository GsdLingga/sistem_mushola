@extends('layouts.app2')
@section('title', 'Tambah Siswa')
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
                <h4 class="mb-0">Siswa</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Siswa</a></li>
                        <li class="breadcrumb-item active">Tambah Siswa</li>
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
                    <h4 class="card-title">Tambah Siswa</h4>
                    <p class="card-title-desc">
                    </p>
                    <form class="custom-validation" action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="name" id="name" type="text" class="form-control" required placeholder="Type something"/>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Induk</label>
                            <div>
                                <input name="no_induk" id="no_induk" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                @error('no_induk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="control-label">Tanggal Lahir</label>
                            <div class="input-group">
                                <input name="tgl_lahir" id="tgl_lahir" type="text" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                                @error('tgl_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- input-group -->
                        </div>
                        <div class="form-group">
                            <label class="control-label">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control select2" required>
                                <option>Select</option>
                                <optgroup label="Jenis Kelas">
                                    @foreach ($kelas as $kls)
                                        <option value="{{$kls->id}}">{{Str::ucfirst($kls->nama_kelas)}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('kelas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control select2" required>
                                <option>Select</option>
                                <optgroup label="Jenis Kelamin">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </optgroup>
                            </select>
                            @error('jenis_kelamin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" id="alamat" type="text" class="form-control" required placeholder="Type something"/>
                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <div>
                                <input name="telepon" id="telepon" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                @error('telepon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Submit
                                </button>
                                {{-- <button type="reset" class="btn btn-secondary waves-effect">
                                    Cancel
                                </button> --}}
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
