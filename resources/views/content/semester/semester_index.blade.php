@extends('layouts.app2')
@section('title', 'Kelola Kelas')
@push('css')
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .semester_active{
            color: #7cd36f;
        }
    </style>
@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Kelas</h4>
                <a href="{{route('semester.create')}}" type="button" class="btn btn-primary waves-effect waves-light" style="color: white;">
                    <i class="mdi mdi-account-plus align-middle mr-2"></i> Tambah Semester
                </a>
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
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <button type="button" class="btn btn-primary waves-effect waves-light btn-sm" style="color: white;" data-toggle="modal" data-target="#exampleModal">
                            <i class="mdi mdi-account-plus align-middle mr-2"></i> Ubah Semester Aktif
                        </button>
                    </div>
                    <h4 class="card-title mb-4">Daftar Semester</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semester as $sms)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td <?php if($sms->status == 1) echo "class=\"semester_active\""; ?> >{{ $sms->tahun_ajaran }}</td>
                                    <td>
                                        <a href="{{route('semester.edit', $sms->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <form action="{{route('semester.destroy', $sms->id)}}" method="POST" style="display: contents;">
                                            @method('DELETE')
                                            @csrf
                                            <button class="text-danger" style="background-color: transparent; border: 0;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                        </form>
                                    </td>
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
              <h5 class="modal-title" id="exampleModalLabel">Ubah Semester Aktif</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('semester.change') }}" method="POST">
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
        $('#btnSubmit').click(function(){
            if (semester.value === "") {
                alert("There is an empty input")
            }else{
                let semesterValue = semester.value
                $.ajax({
                    type: "POST",
                    url: "/change-semester",
                    data: { "_token": "{{ csrf_token() }}",
                    semesterValue },
                    success: function (response) {
                        console.log(response)
                    },
                    error: function (e) {
                        console.log(e)
                    },
                });
            }
        })
    </script>

@endpush
