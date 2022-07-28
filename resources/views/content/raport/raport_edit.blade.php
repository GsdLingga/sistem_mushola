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
                    <h4 class="card-title">Tambah Nilai</h4>
                    <p class="card-title-desc">
                    </p>
                    <form class="custom-validation" action="{{ route('raport.update', $raport->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        {{-- <div class="form-group" id="kelasDiv">
                            <label class="control-label">Nama Kelas</label>
                            <select name="kelasValue" id="selectKelas" class="form-control select2" required>
                                <option>Select</option>
                                <optgroup label="Nama Kelas">
                                    @foreach ($kelas as $kls)
                                        <option <?php if($raport->id_kelas == $kls->id) echo "selected=\"selected\""; ?> value="{{ $kls->id }}">{{ $kls->nama }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('kelasValue')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        {{-- <div class="form-group">
                            <label class="control-label">Nama Siswa</label>
                            <select name="nama" id="nama" class="form-control select2" required>
                                <option>Select</option>
                                <optgroup label="Nama Siswa">
                                    @foreach ($siswa as $siswas)
                                        <option <?php if($raport->id_siswa == $siswas->id) echo "selected=\"selected\""; ?> value="{{ $siswas->id }}">{{ $siswas->nama }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label>Siswa</label>
                            <div>
                                <input name="nama" id="nama" value="{{ $siswa->nama }}" type="text" class="form-control" required disabled/>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alquran</label>
                            <div>
                                <input name="alquran" id="alquran" value="{{ $raport->alquran }}" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                @error('alquran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Iqro</label>
                            <div>
                                <input name="iqro" id="iqro" value="{{ $raport->iqro }}" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                @error('iqro')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Aqidah Akhlak</label>
                            <div>
                                <input name="aqidah_akhlak" id="aqidah_akhlak" value="{{ $raport->aqidah_akhlak }}" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                @error('aqidah_akhlak')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Hafalan Surat</label>
                            <div>
                                <input name="hafalan_surat" id="hafalan_surat" value="{{ $raport->hafalan_surat }}" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                @error('hafalan_surat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>PAI</label>
                            <div>
                                <input name="pai" id="pai" value="{{ $raport->pai }}" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                @error('pai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tajwid</label>
                            <div>
                                <input name="tajwid" id="tajwid" value="{{ $raport->tajwid }}" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                @error('tajwid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Khot</label>
                            <div>
                                <input name="khot" id="khot" value="{{ $raport->khot }}" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                @error('khot')
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
