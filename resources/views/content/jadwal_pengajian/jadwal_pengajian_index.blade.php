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
                    <div id='calendar'></div>

                    <div style='clear:both'></div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="card-title mb-4">Daftar Siswa</h4>
                    <p class="card-title-desc">
                        This example shows the multi option. Note how a click on a row will toggle its selected state without effecting other rows,
                        unlike the os and single options shown in other examples.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
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
                                    <td>{{ Carbon\Carbon::parse($siswas->tgl_lahir)->translatedFormat('d F Y') }}</td>
                                    <td>{{ Str::ucfirst($siswas->jenis_kelamin)  }}</td>
                                    <td>{{ $siswas->alamat }}</td>
                                    <td>{{ $siswas->telepon }}</td>
                                    <td>
                                        <a href="{{route('siswa.edit', $siswas->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <form action="{{route('siswa.update', $siswas->id)}}" method="POST" style="display: contents;">
                                            @method('PUT')
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
    </div> --}}
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
        console.log(jadwal);
          
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          
        var calendar = $('#calendar').fullCalendar({
            // titleFormat: { // will produce something like "Tuesday, September 18, 2018"
            //     month: 'long',
            //     year: 'numeric',
            //     day: 'numeric',
            //     weekday: 'long',
            // },
            // hour12:true,
            header:{
                left:"prev,next today",
                center:"title",
                right:"month,basicWeek,basicDay"
            },
            timeFormat: 'H:mm',
            // editable:true,
            // disableDragging:true,
            //add event
            events: jadwal,
            color: 'yellow',   // an option!
            textColor: 'black', // an option!
            // eventClick: function(event) {
            
            // },

            // dropable:false,
            // editable: true,
            // selectable: true,
            
            // themeSystem: 'bootstrap5',
            // default: 'standard',
            // default:{
            //     today:    'today',
            //     month:    'month',
            //     week:     'week',
            //     day:      'day',
            //     list:     'list',
            //     start: 'title', // will normally be on the left. if RTL, will be on the right
            //     center: '',
            //     end: 'today prev,next', // will normally be on the right. if RTL, will be on the left
            //     prev: 'chevron-left',
            //     next: 'chevron-right',
            //     prevYear: 'chevrons-left', // double chevron
            //     nextYear: 'chevrons-right', // double chevron
            // },
            // editable: true,
            // events: SITEURL + "/fullcalender",
            // displayEventTime: false,
            // eventRender: function (event, element, view) {
            //     if (event.allDay === 'true') {
            //             event.allDay = true;
            //     } else {
            //             event.allDay = false;
            //     }
            // },
            // selectable: true,
            // selectHelper: true,
            // select: function (start, end, allDay) {
            //     var title = prompt('Event Title:');
            //     if (title) {
            //         var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
            //         var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
            //         $.ajax({
            //             url: SITEURL + "/fullcalenderAjax",
            //             data: {
            //                 title: title,
            //                 start: start,
            //                 end: end,
            //                 type: 'add'
            //             },
            //             type: "POST",
            //             success: function (data) {
            //                 displayMessage("Event Created Successfully");

            //                 calendar.fullCalendar('renderEvent',
            //                     {
            //                         id: data.id,
            //                         title: title,
            //                         start: start,
            //                         end: end,
            //                         allDay: allDay
            //                     },true);

            //                 calendar.fullCalendar('unselect');
            //             }
            //         });
            //     }
            // },
            // eventDrop: function (event, delta) {
            //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

            //     $.ajax({
            //         url: SITEURL + '/fullcalenderAjax',
            //         data: {
            //             title: event.title,
            //             start: start,
            //             end: end,
            //             id: event.id,
            //             type: 'update'
            //         },
            //         type: "POST",
            //         success: function (response) {
            //             displayMessage("Event Updated Successfully");
            //         }
            //     });
            // },
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
                        // Swal.fire('Saved!', '', 'success')
                        window.location.href = "jadwal-pengajian/" + event.id + "/edit";
                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info')
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
                                    // dataType: 'json',
                                    // cache: false,
                                    // traditional: true, 
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
                // console.log(event.id);
                // var deleteMsg = confirm("Do you really want to delete?");
                // if (deleteMsg) {
                    // $.ajax({
                    //     type: "POST",
                    //     url: SITEURL + '/fullcalenderAjax',
                    //     data: {
                    //             id: event.id,
                    //             type: 'delete'
                    //     },
                    //     success: function (response) {
                    //         calendar.fullCalendar('removeEvents', event.id);
                    //         displayMessage("Event Deleted Successfully");
                    //     }
                    // });
                // }
            }

        });
        
    });
         
    function displayMessage(message) {
        toastr.success(message, 'Event');
    } 
        
</script>
@endpush