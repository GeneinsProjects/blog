@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">

<style type="text/css">
  .modal-backdrop {
    z-index: 1049 !important;
  }
  .modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1040 !important;
    background-color: #000;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12" style="width: 100%;margin-bottom: 10px;">
                            <div class="btn btn-primary btn-sm pull-right add-user-btn"> &nbsp;Add User</div>
                        </div>  
                    </div>
                    <table class="table table-bordered" id="users-table">
                        <thead> 
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Actions</td>
                            </tr> 
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade  create-modal"  style="display: none;" id="addmodal"></div>
    <div class="modal fade  edit-modal"  style="display: none;" id="editmodal"></div>
@endsection

@section('scripts')


<style type="text/css">
  .modal-backdrop {
    z-index: 1049 !important;
  }
  .modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1040 !important;
    background-color: #000;
}
</style>

<script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modal.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript">
    $(function(){
        
        var table = $("#users-table").DataTable({
            bProcessing: true,
            bServerSide: false,
            sServerMethod: "GET",
            'ajax': 'all-users',
            searching: true, 
            paging: true, 
            filtering:true, 
            responsive: true,
            bInfo: false, 
            "columns": [
              
                    {data: 'row',  name: 'row', className: 'text-center',   searchable: false, sortable: true}, 
                    {data: 'name',  name: 'name', className: 'col-md-4 text-left',   searchable: true, sortable: true},
                    {data: 'email',  name: 'email', className: 'col-md-4 text-left',   searchable: true, sortable: true}, 
                    {data: 'action',   name: 'action', className: ' col-md-1 text-center',   searchable: false,  sortable: false},
            ], 
        });

        $(".add-user-btn").click(function(x) {
            x.preventDefault();
            var that = this;
            $("#addmodal").modal();
            $("#addmodal").html('');
            $.ajax({
                url: 'users/create',
                success: function(data) {
                    $("#addmodal").html(data);
                }
            });
        });

      $(document).off('click', '.edit-user-btn').on('click', '.edit-user-btn', function(x){
            var that = this;
            $("#editmodal").modal();
            $("#editmodal").html("");
            $.ajax({
                url: 'users/'+that.dataset.id+'/edit',                    
                success: function(data) {
                    $("#editmodal").html(data);
                }
            }); 
      });
       $(document).off('click', '.del-user-btn').on('click', '.del-user-btn', function(x){
       
            var that = this;
            bootbox.confirm({
              title: "Confirm Delete",
              className: "del-bootbox",
              message: "Are you sure you want to delete user?",
              buttons: {
                  confirm: {
                      label: 'Yes',
                      className: 'btn-success'
                  },
                  cancel: {
                      label: 'No',
                      className: 'btn-danger'
                  }
              },
              callback: function (result) {
                 if(result){
                  var token = '{{csrf_token()}}';

                  $.ajax({
                  url:'users/'+that.dataset.id,
                  type: 'post',
                  data: {_method: 'delete', _token :token},
                  success:function(data){
                    console.log(data);
                    $("#users-table").DataTable().ajax.url( 'all-users' ).load(); 
                        notiff('Success!', data.msg, 'info'); //title, msg, type
                  }
                  }); 
                 }
              }
          });
      });

    });
</script>
@endsection