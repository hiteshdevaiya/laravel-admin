@extends('admin.layouts.master')

@section('title','Module List')

@section('content')

<!-- breadcumd start -->
{!! getBreadcumb('Modules',['modules'=>'Modul List']) !!}
<!-- breadcumd end -->

<!-- view start -->
<div class="row">
    <div class="col-lg-6">
        <a class="btn btn-info waves-effect waves-light mb-3"  href="{{ route('modules.form') }}" role="button"><i class="fas fa-plus"></i> Add New</a>
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
                                <th>Module</th>
                                <th>Status</th>
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
<!-- view end -->
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
                        return  row['status'];
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, row) {
                        return  row['action'];
                    }
                }
            ]
        });
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function updateStatus(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('modules.store') }}",
            data: {
                type: "status",id:id
            },
            success: function (response) {
                console.log(response);
                return false;
            }
        });
    }
</script>       
@endsection