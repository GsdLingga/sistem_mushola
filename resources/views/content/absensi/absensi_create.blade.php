@extends('layouts.app2')
@section('title', 'Kelola Absensi')
@push('css')
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Absensi</h4>
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
                    </div>
                    <h4 class="card-title mb-4">Absensi</h4>
                    <form class="custom-validation" action="{{ route('absensi.store') }}" method="POST">
                        @csrf
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama</th>
                                    <th>Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $absen)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $absen->nama }}</td>
                                        <td>
                                            {{-- <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ordercheck{{ $loop->iteration }}"  name="id_absen[]" value="{{ $absen->id }}">
                                                <label class="custom-control-label" for="ordercheck{{ $loop->iteration }}">&nbsp;</label>
                                            </div> --}}
                                            <div class="custom-control custom-radio">
                                                <div class="row">
                                                    <div class="custom-control custom-radio mr-3">
                                                        <input type="radio" id="hadir{{$loop->iteration}}" name="radio[absen{{$loop->iteration}}]" value="hadir-{{ $absen->id }}" class="custom-control-input" checked>
                                                        <label class="custom-control-label" for="hadir{{$loop->iteration}}">Hadir</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mr-3">
                                                        <input type="radio" id="izin{{$loop->iteration}}" name="radio[absen{{$loop->iteration}}]" value="izin-{{ $absen->id }}" class="custom-control-input">
                                                        <label class="custom-control-label" for="izin{{$loop->iteration}}">Izin</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mr-3">
                                                        <input type="radio" id="alpa{{$loop->iteration}}" name="radio[absen{{$loop->iteration}}]" value="alpa-{{ $absen->id }}" class="custom-control-input">
                                                        <label class="custom-control-label" for="alpa{{$loop->iteration}}">Alpa</label>
                                                    </div>
                                                </div>
                                            </div>   
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
                    </form>
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