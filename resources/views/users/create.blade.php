<div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New User</h4>
        </div>

    {!! Form::open(array('url' => url('users'), 'enctype' => 'multipart/form-data', 'method' => 'POST', 'id' => 'add-user-form', 'files' => true)) !!}
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">  
     
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Name" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email" required>
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

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        {!! Form::submit('Submit', ['class' => 'btn submit-btn btn-info bg-blue bg-darken-1 pull-right']) !!}
      {!! Form::close() !!}
        </div>
    </div>

</div>   

 <!-- Laravel Javascript Validation -->
 <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

 {!! JsValidator::formRequest('App\Http\Requests\UsersRequest', '#add-user-form') !!}

<script type="text/javascript">
    $(function(){
 
        $("#add-user-form").on('submit', function(e) {
            e.preventDefault();
            var that = this;
            if ($("#add-user-form").valid()) {
                $(".submit-btn").addClass("disabled");
                $('button[type=submit], input[type=submit]').prop('disabled', true);

                var formData = new FormData($("form#add-user-form")[0]);

                $.ajax({
                    type: 'POST',
                    url: 'users',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('button[type=submit], input[type=submit]').prop('disabled', false);
                        $(".submit-btn").removeClass("disabled");
                    }
                }).done(function(data) {
                    if (data.success) {
                        $("#users-table").DataTable().ajax.url('all-users').load();
                        notiff('Success!', data.msg, 'success'); //title, msg, type
                        $('#addmodal').modal('toggle');
                    } else {
                        notiff('Error!', data.msg, 'error'); //title, msg, type
                        $('#addmodal').modal('toggle');
                    }
                }).error(function(data) {
                    notiff('Error!', data.msg, 'warning'); //title, msg, type
                    $('#addmodal').modal('toggle');
                });
            }
        });
    });
</script>