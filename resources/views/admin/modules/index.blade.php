@extends('admin.layouts.master')

@section('title','Module List')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Modules</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ url('/index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Modules</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-6">
        <a class="btn btn-info waves-effect waves-light mb-3"  href="{{ route('modules.form') }}" role="button"> Create New Module</a>
    </div>
    <div class="col-lg-6">
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        @if(session()->has('message'))
            {!! session('message') !!}
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Module List</h4>
                <div class="table-responsive">
                        <table id="datatables" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Modules</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        </table>
                </div>
                <!-- end table-responsive -->
            </div>
        </div>
    </div>
</div>
@endsection	

@section('script')
<!-- plugin js -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- Calendar init -->
<script src="{{ URL::asset('assets/js/pages/dashboard.init.js')}}"></script>

<script>
    $(document).ready(function () { 
        loadDashboard();  
    });

    function loadDashboard(){
        var modules_list='modules_list';
        var count=1;
        var table = $('#datatables').DataTable({

            "order": [ 0, 'asc' ],
            "bSort": true,
            "paging": true,
            "bInfo": true,
            "bDestroy": true,
            "bFilter": true,
            "searching": true,
            "bPaginate": true,
            "bProcessing": true,
            "language": {
                "loadingRecords": '&nbsp;',
                "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span>'
            },
            'ajax': {
                "type": "POST",
                "url": "{{ route('modules.list') }}",
                "data": function (d) {
                    d._token= "{{csrf_token()}}",d.request_type=modules_list
                },
                "dataType": 'json',
                "dataSrc": "",
                "timeout":1000000,
                "async": true,
                "cache": true
            },
            success:function($res){
                // alert("hii");
                console.log("hhh");
                // return false;
            },
            'columnDefs': [
                {
                    targets: 0,
                    render: function (data, type, row) {
                        return  count++;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                        return  row['module'];
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {
                        return  row['action'];
                    }
                }

                
            ]
        });
    }
</script>       
@endsection