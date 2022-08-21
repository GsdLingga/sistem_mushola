@extends('layouts.app2')
@section('title', 'Jadwal Pengajian')
@push('css')
    <!-- Plugin css -->
    {{-- <link href="{{asset('assets/libs/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Jadwal Pengajian</h4>

                <a href="{{route('jadwal-pengajian.create')}}" type="button" class="btn btn-primary waves-effect waves-light" style="color: white;">
                    <i class="mdi mdi-account-plus align-middle mr-2"></i> Tambah Jadwal Pengajian
                </a>

                {{-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Nazox</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div> --}}

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
                    <div id='calendar'></div>

                    <div style='clear:both'></div>
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

    <!-- plugin js -->
    <script src="{{asset('assets/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-ui-dist/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/libs/fullcalendar/fullcalendar.min.js')}}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Calendar init -->
    {{-- <script src="{{asset('assets/js/pages/calendar.init.js')}}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script> --}}

    <script>
    $(document).ready(function () {

        // var SITEURL = "{{ url('/') }}";

        //get jadwal_pengajian value from controller
        var jadwal= {!! json_encode($jadwal_pengajian) !!};
        // console.log(jadwal);

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            header:{
                left:"prev,next today",
                center:"title",
                right:"month,basicWeek,basicDay"
            },
            timeFormat: 'H:mm',
            events: jadwal,
            color: 'yellow',   // an option!
            textColor: 'black', // an option!
            eventClick: function (event) {
                Swal.fire({
                    title: 'Select Action',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Edit',
                    denyButtonText: `Delete`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = "jadwal-pengajian/" + event.id + "/edit";
                    } else if (result.isDenied) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let token = $('meta[name="csrf-token"]').attr('content');
                                $.ajax({
                                    type: "DELETE",
                                    url: 'jadwal-pengajian/' + event.id,
                                    data: {
                                        _token: token,
                                        id: event.id,
                                    },
                                    success: function (response) {
                                        calendar.fullCalendar('removeEvents', event.id);
                                        Swal.fire(
                                            'Deleted!',
                                            'Your file has been deleted.',
                                            'success'
                                        )
                                    }
                                });
                            }
                        })
                    }
                })
            }

        });

    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }

</script>
@endpush
