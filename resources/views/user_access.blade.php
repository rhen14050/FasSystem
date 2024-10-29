@extends('layouts.admin_layout')

  @section('title', 'User')

  @section('content_page')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Access</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">User Access</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Access</h3>
              </div>

              <!-- Start Page Content -->
              <div class="card-body">
                  <div style="float: right;">                   

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddUser" id="btnShowAddUserModal"><i class="fa fa-user-plus"></i> Add User Access</button>
                  </div> <br><br>
                  <div class="table responsive">
                    <table id="tblUsers" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>Action</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Department</th>
                          <th>Access Level</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
              </div>
              <!-- !-- End Page Content -->

            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="modalAddUser">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-user-plus"></i> Add User Access</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <div class="modal-body">

          <form id="formAddUser" method="post">
          @csrf

          <div class="row">
            <div class="col-sm-12">
              <input type="hidden" name="user_details_id" id="userDetailsId">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <label>RapidX User</label>
              <select class="form-control sel-rapidx-user-list" id="rapidXUserId" name="rapidx_user">
                <option selected disabled>-- Select One --</option>
              </select>
            </div>
          </div>

           <div class="row">
            <div class="col-sm-12">
              <label>Access Level</label>
              <select class="form-control" id="accessLevelId" name="access_level">
                <option selected disabled>-- Select One --</option>
                <option value="1">Regular User</option>
                <option value="2">Approver</option>
                <option value="3">Administrator</option>
                {{-- <option value="4">Administrator</option> --}}
              </select>
            </div>
          </div>

           <div class="row">
            <div class="col-sm-12">
              <label>Department</label>
              <select class="form-control" id="userSectionId" name="user_section">
                <option selected disabled>-- Select One --</option>   
                <option value="FAS">FAS</option>
                <option value="ISS">ISS</option>
                <option value="TS Eng">TS Eng</option>
                <option value="TS Prod">TS Prod</option>
                <option value="TS QC">TS QC</option>
                <option value="TS WHSE">TS WHSE</option>
                <option value="PPC">PPC</option>
                <option value="CN">CN</option>
                <option value="CN 2A QC">CN 2A QC</option>
                <option value="CN 2B">CN 2B</option>
                <option value="CN WHSE">CN WHSE</option>
                <option value="PPS">PPS</option>
                <option value="PPS CN">PPS CN</option>
                <option value="YF">YF</option>
                <option value="TS - Design Engineering">TS - Design Engineering</option>
              </select>
            </div>
          </div>

          </form>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnSaveAddUser">Save User</button>
        </div>

      </div>
    </div>
  </div>

  @endsection

  @section('js_content')

  <script type="text/javascript">

    // let dt_users;

$(document).ready(function () {
//     bsCustomFileInput.init();

    LoadRapidXUserList($('.sel-rapidx-user-list'));

    $('.select2').select2({
        theme: "bootstrap-5"
    });

    dt_users = $('#tblUsers').DataTable({

       "processing" : true,
        "serverSide" : true,

        "ajax" : {
          url: "load_access_level",
          data: function (param){

          }
        },

        "columns":[
          { "data" : "action" },
          { "data" : "username" },
          { "data" : "fullname" },
          { "data" : "section" },
          { "data" : "access_level" }, 
        ],

        "order":[3,'desc']

    });

    $(document).on('click','.btn-edit-user', function(e){
      e.preventDefault();
      let userId = $(this).attr('user-id');
      $('#userDetailsId').val(userId);
      // console.log(userId);
      getUserToEdit(userId);
    });

    $('#btnSaveAddUser').click(function(){
      saveUserDetails();
    });

    $(document).on('click', '.btn-deactivate-user', function(e){
      e.preventDefault();
      let userId = $(this).attr('user-id');
      Swal.fire({
            title: 'Are you sure you want to DEACTIVATE the user?',
            showCancelButton: true,
            confirmButtonColor: '#FF0000',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, DEACTIVATE!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  type: "get",
                  url: "deactivate_user",
                  data: {
                    user_id: userId
                  },
                  dataType: "json",
                  success: function (response) {
                    console.log(response);
                    if(response['result'] == 1){
                      $("#modalAddUsertest").modal('hide');
                      $("#formAddUsertest")[0].reset();        

                      // console.log('success');
                      dt_users.draw();
                      toastr.success('Request succesfully saved!');       
                    }else{
                      $("#modalAddUsertest").modal('hide');
                      $("#formAddUsertest")[0].reset();   
                      dt_users.draw();
                    }
                  },
                  error: function(data, xhr, status){
                    toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
                  }
              });
            }
          });
    });

    function saveUserDetails(){
        $.ajax({
          url: 'add_user_access',
          method: "post",
          data: $('#formAddUser').serialize(),
          dataType: "json",
            beforeSend: function(){
            },
            success: function(JsonObject){
              if(JsonObject['result'] == 'Record updated successfully.'){
                $('#formAddUser')[0].reset();
                $('#modalAddUser').modal('hide');
                toastr.success('User was Succesfully Updated!');

                dt_users.draw();
              }else if(JsonObject['result'] == 'Record created successfully.'){
                $('#formAddUser')[0].reset();
                $('#modalAddUser').modal('hide');
                toastr.success('User was Succesfully Saved!');

                dt_users.draw();
              }
              else{
                toastr.error('Record already exists!');
              }
            },
              error: function(data, xhr, status){
                  alert('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
                  toastr.error('Error Saving the User!');
              }
        });
      
    }
    

});

  </script>

  @endsection