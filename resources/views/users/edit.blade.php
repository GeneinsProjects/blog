<div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit User</h4>
        </div>

    {!! Form::open(array('url' => url('users/'.$user->id), 'enctype' => 'multipart/form-data', 'method' => 'PATCH', 'id' => 'edit-user-form', 'files' => true)) !!}
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">  
     
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Name" required value="{{ $user->name }}">
                  </div>
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email" required value="{{ $user->email }}">
                  </div>
 
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" required>
                  </div>

                </div>
            </div>


                    {{Form::hidden('_method','PATCH')}}


        {{ csrf_field() }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            <div class="btn submit-btn btn-info bg-blue bg-darken-1 pull-right">Submit</div> 
      {!! Form::close() !!}
        </div>
    </div>

</div>   
 

 <!-- Laravel Javascript Validation -->
 <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

 {!! JsValidator::formRequest('App\Http\Requests\UpdateUsers', '#add-user-form') !!}
<script type="text/javascript">
    $(function(){

         
        $(document).off('click', ".submit-btn").on('click', ".submit-btn", function(e){
        //$("#edit-user-form").on('submit', function(e) {
            e.preventDefault();  
            var that = this;
            if ($("#edit-user-form").valid()) {
                $(".submit-btn").addClass("disabled");
                $('button[type=submit], input[type=submit]').prop('disabled', true);

                var formData = new FormData($("form#edit-user-form")[0]);

                $.ajax({
                    type: 'POST',
                    url: 'users/{{ $user->id }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('button[type=submit], input[type=submit]').prop('disabled', false);
                        $(".submit-btn").removeClass("disabled");
                    }
                }).done(function(data) {
                    if (data.success) {
                        $("#users-table").DataTable().ajax.url('all-users').load();
                        notiff('Success!', data.msg, 'success'); //title, msg, type
                        $('#editmodal').modal('toggle');
                    } else {
                        notiff('Error!', data.msg, 'error'); //title, msg, type
                        //$('#editmodal').modal('toggle');
                    }
                }).error(function(data) {
                    notiff('Error!', data.msg, 'warning'); //title, msg, type
                    //$('#editmodal').modal('toggle');
                });
            }
        });
    });
</script>