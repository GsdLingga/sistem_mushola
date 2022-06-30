@extends('layouts.app2')
@section('title', 'Kelola Siswa')
@push('css')
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Siswa</h4>

                <a href="{{route('siswa.create')}}" type="button" class="btn btn-primary waves-effect waves-light" style="color: white;">
                    <i class="mdi mdi-account-plus align-middle mr-2"></i> Tambah Siswa
                </a>

                {{-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Nazox</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div> --}}

            </div>
            @if ($errors->any())
                <div class="alert alert-dange alert-dismissible fade showr" role="alert">
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
                    </div>
                    <h4 class="card-title mb-4">Daftar Siswa</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $siswas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswas->nama }}</td>
                                    <td>{{ Str::ucfirst($siswas->kelas) }}</td>
                                    <td>{{ Str::ucfirst($siswas->jenis_kelamin)  }}</td>
                                    <td>{{ $siswas->alamat }}</td>
                                    <td>{{ $siswas->telepon }}</td>
                                    <td>
                                        <a href="{{route('siswa.edit', $siswas->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <form action="{{route('siswa.destroy', $siswas->id)}}" method="POST" style="display: contents;">
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

@endpush