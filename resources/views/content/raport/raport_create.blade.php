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
                    <form class="custom-validation" action="{{ route('raport.store') }}" method="POST">
                        @csrf
                        <div class="form-group" id="kelasDiv">
                            <label class="control-label">Nama Kelas</label>
                            <select name="kelasValue" id="selectKelas" class="form-control select2" required>
                                <option>Select</option>
                                <optgroup label="Nama Kelas">
                                    @foreach ($kelas as $kls)
                                        <option value="{{ $kls->id }}">{{ Str::ucfirst($kls->nama_kelas) }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('kelasValue')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" id="siswaDiv">
                            <label class="control-label">Nama Siswa</label>
                            <select name="nama" id="selectSiswa" class="form-control select2" required>
                                <option>Select</option>
                                <optgroup label="Nama Siswa">
                                    {{-- @foreach ($siswa as $siswas)
                                        <option value="{{ $siswas->id }}">{{ $siswas->nama }}</option>
                                    @endforeach --}}
                                </optgroup>
                            </select>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alquran</label>
                            <div>
                                <input name="alquran" id="alquran" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
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
                                <input name="iqro" id="iqro" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
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
                                <input name="aqidah_akhlak" id="aqidah_akhlak" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
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
                                <input name="hafalan_surat" id="hafalan_surat" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
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
                                <input name="pai" id="pai" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
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
                                <input name="tajwid" id="tajwid" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
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
                                <input name="khot" id="khot" data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers"/>
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

    <script>
        let kelas = document.getElementById('selectKelas');
        let siswa = document.getElementById('selectSiswa');
        let kelasDiv = document.getElementById('kelasDiv')
        let siswaDiv = document.getElementById('siswaDiv')

        $('#selectKelas').change(function(){
            let kelasValue = kelas.value;
            $.ajax({
                type: "GET",
                url: "/api/getSiswaCreate",
                data: {
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
                error: function () {
                    alert("error");
                },
            });
        })

        function removeOptions(selectElement) {
            var i, L = selectElement.options.length - 1;
            for(i = L; i >= 0; i--) {
                selectElement.remove(i);
            }
        }
    </script>
@endpush
