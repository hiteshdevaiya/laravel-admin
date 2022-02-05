@extends('admin.layouts.master')

@section('title') User List @endsection

@section('content')

<!-- breadcumd start -->
{!! getBreadcumb('user list','user','users') !!}
<!-- breadcumd end -->

<!-- view start -->
<div class="row">
    <div class="col-lg-6">
        <a class="btn btn-info waves-effect waves-light mb-3"  href="{{ route('users.form') }}" role="button"><i class="fas fa-plus"></i> Add New</a>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- view end -->
@endsection
@section('script')

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function updateActiveStatus(activeStatus,id) {
        var user_type = 'updatestatus';
        $.ajax({
            type: "POST",
            url: '{{ route('users.store') }}',
            data: {
                active_status : activeStatus,
                id : id,
                user_type : user_type,
            },
            success: function (response) {
            }
        });
    }

$(document).ready(function () {
    
                     loadDashboards();
        });
        function loadDashboards(){
             id=$('#user_id').val();
              var dt = $('#datatables').DataTable();
             // alert(dt);      
           
           var admin_users_list='admin_users_list';
            var count=1;
            var table = $('#datatables').DataTable({

                "order": [ 0, 'asc' ],
                dom: 'Bfrtip',
                buttons:[
                'csvHtml5'  
                ],
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
                    "url": "{{ route('users.list') }}",
                    "data": function (d) {
                        d._token= "{{csrf_token()}}"
                    },
                    "dataType": 'json',
                    "dataSrc": "",
                    "timeout":1000000,
                    "async": true,
                    "cache": true
                },
                success:function($res){
                    console.log(res);
                    return false;
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
                            return  row['name'];
                        }
                    },
                    {
                         targets: 2,
                        render: function (data, type, row) {
                            return row['email'];
                        }
                    },
                    {
                        targets: 3,
                        render: function (data, type, row) {
                            return row['role'];
                        }
                    },
                    {
                        targets: 4,
                        render: function (data, type, row) {
                            return row['status'];
                        }
                    },
                    {
                        targets: 5,
                        render: function (data, type, row) {
                            return row['action'];
                        }
                    }
                ]
            });
        }


$(document).on('click', '#button', function () {
    //e.preventDefault();
    var $ele = $(this).parent().parent();
    var id = $(this).data('id');
    var url = "{{URL('users')}}";
    var destroyurl = url+"/"+id;

    swal({
            title: "Are you sure?",
            text: "You want to delete this record",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
             
            $.ajax({
                type: "DELETE",
                url:destroyurl, 
                data:{ _token:'{{ csrf_token() }}'},
                dataType: "html",
                success: function (data) {
                    var dataResult = JSON.parse(data);
                if(dataResult.statusCode==200){
                $ele.fadeOut().remove();
                swal({
                    title: "Done!",
                    text: "It was succesfully deleted!",
                    type: "success",
                    timer: 700
                });   
            } 
        }
        });
        }else
        {
             swal("Cancelled", "", "error");
        }
    });
});

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function updateStatus(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('users.store') }}",
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