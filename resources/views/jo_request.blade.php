@extends('layouts.admin_layout')

@section('title', 'Blank')

@section('content_page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Job Order Requests</h1>
        </div>
        <div class="col-sm-6">
<!--           <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Job Order Request</li>
          </ol> -->
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
              <div class="float-sm-right">
                <button type="button" class="btn btn-sm btn-success" id="btnNewJORequest" data-bs-toggle="modal" data-bs-target="#modalNewJORequest"><i class="fa fa-plus"></i> New JO Request</button>
              </div>
            </div>
            <!-- Start Page Content -->
            <div class="card-body">
        
              <div class="dt-responsive table-responsive">
                <table id="tbl_JO_Requests" class="table table-striped table-bordered" style="width: 100%; font-size: 90%;">
                  <thead>
                    <tr>
                      <th>Action</th>                            
                      <th>Request Status</th>
                      <th>Request Conformance Status</th>
                      <th>Control Number</th>
                      <th>Job Description</th>    
                      <th>Initial Action</th>    
                      <th>Attachment</th>    
                      {{-- <th>Department</th> --}}
                      <th>Prepared by</th>     
                      <th>Job Classfication</th>    
                      <th>FAS Assessment</th>
                      <th>Estimated Completion Date</th>    
                      <th>Assessed by</th> 
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
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

<!-- Add Request Modal -->
<div class="modal fade" id="modalNewJORequest" data-bs-backdrop="static">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Job Order Request</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="post" id="formAddJORequest">
      @csrf
      <div class="modal-body">      
        <div class="row">
          <div class="col-sm-6">
              <!--JO NO.-->
              
              <input type="hidden" class="form-control" id="requestId" name="request_id" readonly>
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">JO NO.</span>
                    </div>                 
                    <input type="text" class="form-control" id="generated_jo_no" name="jo_no" readonly>
                  </div>
                </div>
              </div>          

            </div>
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
              <!--EQUIPMENT NAME-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">EQUIPMENT NAME</span>
                    </div>
                    
                    <input type="text" class="form-control" id="add_equipment_name" name="equipment_name" autocomplete="off">

                  </div>
                </div>
              </div>

              <!--REQUESTOR-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">REQUESTOR</span>
                    </div>
                    <input type="hidden" class="form-control" id="add_requestor_id" name="requestor_id" readonly>
                    <input type="text" class="form-control" id="add_requestor" name="requestor" readonly>
                  </div>
                </div>
              </div>

              <!--DEPARTMENT-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">DEPARTMENT</span>
                    </div>
                    <input type="text" class="form-control" id="add_department" name="department" readonly>
                  </div>
                </div>
              </div>

              <!--JO REQUEST TYPE-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">REQUEST TYPE</span>
                    </div>                  
                    <select class="form-control" id="add_jo_request_type" name="jo_request_type">
                      <option value="0" selected disabled>-- Select Type --</option>
                      <option value="1">Without Attachment</option>
                      <option value="2">With Attachment</option>
                    </select>  
                  </div>
                </div>
              </div>

              <!--JO REQUEST ATTACHMENT-->
              <div class="row d-none show_attachment">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">REQUEST ATTACHMENT</span>
                    </div>                  
                    <input type="text" class="form-control d-none" name="reuploaded_file" id="txtEditReuploadedfile" readonly><br>
                  </div>
                </div>
              </div>
              
              <div class="form-group form-check d-none show_checkbox">
                  <input type="checkbox" class="form-check-input chxbx" name="checkbox" id="check_box">
                  <label id="labelId">Reupload Attachment?</label>
              </div>                  


              <!--Attachment-->
              <div class="row d-none show_upload_attachment">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">ADD ATTACHMENT</span>
                    </div>
                    <input type="file" class="form-control" id="add_attachment" name="add_attachment" readonly>
                  </div>
                </div>
              </div>

              <!--ALLOCATED BUDGET-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">ALLOCATED BUDGET</span>
                    </div>
                    
                    
                    <select class="form-control" id="add_budget_type" name="budget_type">
                      <option value="0" selected disabled>-- Select Type --</option>
                      <option value="1">$</option>
                      <option value="2">PHP</option>
                    </select> 

                    <input type="number" class="form-control" id="add_allocated_budget" name="allocated_budget">

                  </div>
                </div>
              </div>

              <!--JO REQUEST Checker-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">CHECKED BY</span>
                    </div>                
                    <select class="form-control sel-checked-by" id="add_jo_request_checker" name="jo_request_checker">
                      <option value="0" selected disabled>-- Select Checker --</option>
                    </select>
                  </div>
                </div>
              </div>

              <!--JO REQUEST APPROVER-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">APPROVER</span>
                    </div>                
                    <select class="form-control sel-rapidx-section-heads" id="add_jo_request_approver" name="jo_request_approver">
                      <option value="0" selected disabled>-- Select Approver --</option>
                    </select>
                  </div>
                </div>
              </div>


            </div>

            <div class="col-sm-6">
              <!--EQUIPMENT NO-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">EQUIPMENT NUMBER</span>
                    </div>
                    
                    <input type="text" class="form-control" id="add_equipment_number" name="equipment_number" autocomplete="off">

                  </div>
                </div>
              </div>

              <!--DATE PREPARED-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">DATE PREPARED</span>
                    </div>
                    
                    <input type="text" class="form-control" id="add_date_prepared" name="date_prepared" value="<?php echo date('Y-m-d');?>" readonly>

                  </div>
                </div>
              </div>         

              <!--Place to conduct JO-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">FACTORY CLASSIFICATION</span>
                    </div>
                    
                    <select class="form-control" id="add_factory" name="factory_classification">
                      <option value="0" selected disabled>-- Select Classification --</option>
                      <option value="1">Factory 1</option>
                      <option value="2">Factory 3</option>               
                    </select>
                  </div>
                </div>
              </div> 

              <!--JOB DESCRIPTION-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">JOB DESCRIPTION</span>
                    </div>
                    
                    <textarea class="form-control" id="add_jo_description" name="jo_description" rows="4" style="resize: none;"></textarea> 

                  </div>
                </div>
              </div>   

              <!--INITIAL ACTION-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">INITIAL ACTION</span>
                    </div>
                    
                    <textarea class="form-control" id="add_initial_action" name="initial_action" rows="4" style="resize: none;"></textarea> 

                  </div>
                </div>
              </div>   
            </div>            
        </div>  
      </div> 

      <div class="modal-footer">
        <button type="submit" id="btnSubmitJORequest" class="btn btn-primary"><i id="ibtnSubmitJORequestDefIcon" class="fa fa-submit"></i> Submit Request</button>
      </div>
      
    </form>
    </div>
  </div>
</div>

<!--Checked Request-->
<div class="modal fade" id="modalCheckedRequest"  data-bs-backdrop="static">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-check-circle"></i> Job Order Request - Approval</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formCheckedJORequest">
      @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <label>Request Details</label>
          </div>
        </div>      
      <div class="row">
        <div class="col-sm-6">     
            <!--JO NO.-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">Jo No.</span>
                  </div>

                  <input type="hidden" class="form-control" name="check_request_id" id="txtRequestCheckId" readonly>
                  <input type="hidden" class="form-control" name="check_approval_status" id="txtCheckedStatus" readonly>
                  <input type="text" class="form-control" name="generated_jo_no" id="txtJO_No" readonly>

                </div>
              </div>
            </div>    
          </div>
          <div class="col-sm-6">

          </div>
          
          <div class="col-sm-6">
             <!--EQUIPMENT NAME-->
             <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">EQUIPMENT NAME</span>
                  </div>
                  
                  <input type="text" class="form-control" id="txtEquipmentName" name="equipment_name" readonly>

                </div>
              </div>
            </div>

             <!--REQUESTOR-->
             <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">Requestor</span>
                  </div>
                  <input type="hidden" class="form-control" name="approve_requestor_id" id="txtRequestorId" readonly>
                  <input type="text" class="form-control" name="add_requestor" id="txtRequestor" readonly>
                </div>
              </div>
            </div>

            <!--DEPARTMENT-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">Department</span>
                  </div>
                  
                  <input type="text" class="form-control" name="add_department" id="txtDepartment" readonly>

                </div>
              </div>
            </div>

          <!--ALLOCATED BUDGET-->
          <div class="row">
            <div class="col">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend w-50">
                  <span class="input-group-text w-100" id="basic-addon1">ALLOCATED BUDGET</span>
                </div>

                <input type="text" class="form-control" id="txtBudgetType" name="allocated_budget" readonly>
                <input type="text" class="form-control" id="txtAllocatedBudget" name="allocated_budget" readonly>

              </div>
            </div>
          </div>

            <!--Attachment-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">Attachment</span>              
                  </div>    
                  <div class="input-group-prepend w-50">   
                    {{-- <span class="input-group-text w-100" name="attachment" id="txtAttachmentFileName"></span>    --}}
                    <input type="text" class="form-control" name="attachment" id="txtAttachmentFileName" readonly>
                  </div>                        
                </div>
              </div>
            </div>

             <!--JO REQUEST CHECKER-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">CHECKER</span>
                  </div>                  
                  <input type="text" class="form-control" name="jo_checker" id="txtCheckedy" readonly>
                </div>
              </div>
            </div>

            <!--JO REQUEST APPROVER-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">Approver</span>
                  </div>                  
                  <!-- Conformed By -->
                  <input type="hidden" class="form-control" name="conformed_by" id="txtConformedBy" readonly>
                  <!-- Conformed By -->
                  <input type="text" class="form-control" name="jo_request_approver" id="txtJoRequestApprover" readonly>
                </div>
              </div>
            </div>

        </div>

        <div class="col-sm-6">
          <!--EQUIPMENT NO-->
          <div class="row">
            <div class="col">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend w-50">
                  <span class="input-group-text w-100" id="basic-addon1">EQUIPMENT NUMBER</span>
                </div>
                
                <input type="text" class="form-control" id="txtEquipmentNumber" name="equipment_number"readonly>

              </div>
            </div>
          </div>

          <!--DATE PREPARED-->
          <div class="row">
            <div class="col">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend w-50">
                  <span class="input-group-text w-100" id="basic-addon1">Date Prepared</span>
                </div>
                
                <input type="text" class="form-control" name="date_prepared" id="txtDatePrepared" readonly>

              </div>
            </div>
          </div>    
          
          <!--Place to conduct JO-->
          <div class="row">
            <div class="col">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend w-50">
                  <span class="input-group-text w-100" id="basic-addon1">FACTORY CLASSIFICATION</span>
                </div>
                <input type="text" class="form-control" name="factory_classification" id="txtFactoryClassification" readonly>
              </div>
            </div>
          </div> 

          <!--JOB DESCRIPTION-->
          <div class="row">
            <div class="col">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend w-50">
                  <span class="input-group-text w-100" id="basic-addon1">JOB DESCRIPTION</span>
                </div>
                <textarea class="form-control" id="txtJoDescription" name="jo_description" rows="4" style="resize: none;" readonly></textarea> 
              </div>
            </div>
          </div>   

          <!--INITIAL ACTION-->
          <div class="row">
            <div class="col">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend w-50">
                  <span class="input-group-text w-100" id="basic-addon1">INITIAL ACTION</span>
                </div>
                
                <textarea class="form-control" id="txtInitialAction" name="initial_action" rows="4" style="resize: none;" readonly></textarea> 

              </div>
            </div>
          </div> 

                        

          
        </div>          
      </div>    
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger mr-auto" chkvalue="2" id="btnDisapproveCheckedRequest"><i id="iBtnDisapproveCheckedRequest"></i> Disapprove Request</button>

        <button type="button" class="btn btn-sm btn-success" chkvalue="1" id="btnCheckedRequest"><i id="iBtnCheckedRequest"></i> Approve Request</button>
      </div>
    </form>

    </div>
  </div>
</div>

<!--Approved Request-->
<div class="modal fade" id="modalApprovedRequest"  data-bs-backdrop="static">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-check-circle"></i> Job Order Request - Approval</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formApprovedJORequest">
      @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <label>Request Details</label>
          </div>
        </div>      
        <div class="row">
          <div class="col-sm-6">     
              <!--JO NO.-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Jo No.</span>
                    </div>

                    <input type="hidden" class="form-control" name="approve_request_id" id="txtRequestId" readonly>
                    <input type="hidden" class="form-control" name="approve_approval_status" id="txtApprovalStatus" readonly>
                    <input type="text" class="form-control" name="generated_jo_no" id="txtApprovedJO_No" readonly>

                  </div>
                </div>
              </div>    
            </div>
            <div class="col-sm-6">

            </div>
            
            <div class="col-sm-6">
              <!--EQUIPMENT NAME-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">EQUIPMENT NAME</span>
                    </div>
                    
                    <input type="text" class="form-control" id="txtApprovedEquipmentName" name="approve_equipment_name" readonly>

                  </div>
                </div>
              </div>

              <!--REQUESTOR-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Requestor</span>
                    </div>
                    <input type="hidden" class="form-control" name="approve_requestor_id" id="txtApprovedRequestorId" readonly>
                    <input type="text" class="form-control" name="add_requestor" id="txtApprovedRequestor" readonly>
                  </div>
                </div>
              </div>

              <!--DEPARTMENT-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Department</span>
                    </div>
                    
                    <input type="text" class="form-control" name="add_approved_department" id="txtApprovedDepartment" readonly>

                  </div>
                </div>
              </div>

            <!--ALLOCATED BUDGET-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">ALLOCATED BUDGET</span>
                  </div>

                  <input type="text" class="form-control" id="txtApprovedBudgetType" name="allocated_approve_budget" readonly>
                  <input type="text" class="form-control" id="txtApprovedAllocatedBudget" name="allocated_approve_budget" readonly>

                </div>
              </div>
            </div>

              <!--Attachment-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Attachment</span>              
                    </div>    
                    <div class="input-group-prepend w-50">   
                      {{-- <span class="input-group-text w-100" name="attachment" id="txtApprovedAttachmentFileName"></span>    --}}
                      <input type="text" class="form-control" name="approve_attachment" id="txtApprovedAttachmentFileName" readonly>
                    </div>                        
                  </div>
                </div>
              </div>

              <!--JO REQUEST CHECKER-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">CHECKER</span>
                    </div>                  
                    <input type="text" class="form-control" name="approve_jo_checker" id="txtApprovedCheckedy" readonly>
                  </div>
                </div>
              </div>

              <!--JO REQUEST APPROVER-->
              <div class="row">
                <div class="col">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100" id="basic-addon1">Approver</span>
                    </div>                  
                    <!-- Conformed By -->
                    <input type="hidden" class="form-control" name="approve_conformed_by" id="txtApprovedConformedBy" readonly>
                    <!-- Conformed By -->
                    <input type="text" class="form-control" name="approve_jo_request_approver" id="txtApprovedJoRequestApprover" readonly>
                  </div>
                </div>
              </div>

          </div>

          <div class="col-sm-6">
            <!--EQUIPMENT NO-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">EQUIPMENT NUMBER</span>
                  </div>
                  
                  <input type="text" class="form-control" id="txtApprovedEquipmentNumber" name="approve_equipment_number"readonly>

                </div>
              </div>
            </div>

            <!--DATE PREPARED-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">Date Prepared</span>
                  </div>
                  
                  <input type="text" class="form-control" name="approve_date_prepared" id="txtApprovedDatePrepared" readonly>

                </div>
              </div>
            </div>    
            
            <!--Place to conduct JO-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">FACTORY CLASSIFICATION</span>
                  </div>
                  <input type="text" class="form-control" name="approve_factory_classification" id="txtApprovedFactoryClassification" readonly>
                </div>
              </div>
            </div> 

            <!--JOB DESCRIPTION-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">JOB DESCRIPTION</span>
                  </div>
                  <textarea class="form-control" id="txtApprovedJoDescription" name="approve_jo_description" rows="4" style="resize: none;" readonly></textarea> 
                </div>
              </div>
            </div>   

            <!--INITIAL ACTION-->
            <div class="row">
              <div class="col">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">INITIAL ACTION</span>
                  </div>
                  
                  <textarea class="form-control" id="txtApprovedInitialAction" name="approve_initial_action" rows="4" style="resize: none;" readonly></textarea> 

                </div>
              </div>
            </div> 

          </div>          
        </div>    
    </div>
  
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger mr-auto" apprvValue="4" id="btnDisapprovedRequest"><i id="iBtnDisapproveRequest"></i> Disapprove Request</button>

        <button type="button" class="btn btn-sm btn-success" apprvValue="3" id="btnApprovedRequest"><i id="iBtnApprovedRequest"></i> Approve Request</button>
      </div>
    </form>

    </div>
  </div>
</div>

<!--View Conformed Request-->
<div class="modal fade" id="modalConformRequest"  data-bs-backdrop="static">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">

      <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-eye"></i>Conformance Details</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form id="formConformRequest">
      @csrf
      <div class="modal-body">
          <div class="row">
              <div class="col-sm-12">
                  <label>Request Details</label>
              </div>
          </div>      
              <div class="row"></div>      
                  <div class="row">
                      <div class="col-sm-6">     
                          <!--JO NO.-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">Jo No.</span>
                              </div>

                              <input type="hidden" class="form-control" name="conform_request_id" id="conformRequestId" readonly>
                              <input type="hidden" class="form-control" name="jo_request_id" id="joRequestId" readonly>
                              <input type="hidden" class="form-control" name="conformance_status" id="txtconformanceStatus" readonly>
                              <input type="text" class="form-control" name="generated_jo_no" id="txtJoNo" readonly>

                              </div>
                          </div>
                          </div>    
                      </div>
                      <div class="col-sm-6">

                      </div>
                      
                      <div class="col-sm-6">
                          <!--EQUIPMENT NAME-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">EQUIPMENT NAME</span>
                              </div>
                              
                              <input type="text" class="form-control" id="txtEquipName" name="equipment_name" readonly>

                              </div>
                          </div>
                          </div>

                          <!--REQUESTOR-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">Requestor</span>
                              </div>
                              <input type="hidden" class="form-control" name="requestor_id" id="txtCRequestorId" readonly>
                              <input type="text" class="form-control" name="requestor" id="txtCRequestor" readonly>
                              </div>
                          </div>
                          </div>

                          <!--DEPARTMENT-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">Department</span>
                              </div>
                              
                              <input type="text" class="form-control" name="department" id="txtCDepartment" readonly>

                              </div>
                          </div>
                          </div>

                      <!--ALLOCATED BUDGET-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">ALLOCATED BUDGET</span>
                              </div>

                              <input type="text" class="form-control" id="txtCBudgetType" name="allocated_budget_type" readonly>
                              <input type="text" class="form-control" id="txtCAllocatedBudget" name="allocated_budget" readonly>

                          </div>
                          </div>
                      </div>

                          <!--Attachment-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">Attachment</span>              
                              </div>    
                              <div class="input-group-prepend w-50">   
                                  {{-- <span class="input-group-text w-100" name="attachment" id="txtAttachmentFileName"></span>    --}}
                                  <input type="text" class="form-control" name="attachment" id="txtCAttachmentFileName" readonly>
                              </div>                        
                              </div>
                          </div>
                          </div>

                          <!--JO REQUEST CHECKER-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">CHECKER</span>
                              </div>                  
                              <input type="text" class="form-control" name="jo_checker" id="txtCCheckedBy" readonly>
                              </div>
                          </div>
                          </div>

                          <!--JO REQUEST APPROVER-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">Approver</span>
                              </div>                  
                              <!-- Conformed By -->
                              {{-- <input type="text" class="form-control" name="approver" id="txtCApprover" readonly> --}}
                              <!-- Conformed By -->
                              <input type="text" class="form-control" name="jo_request_approver" id="txtCApproverName" readonly>
                              </div>
                          </div>
                          </div>

                      </div>

                      <div class="col-sm-6">
                      <!--EQUIPMENT NO-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">EQUIPMENT NUMBER</span>
                              </div>
                              
                              <input type="text" class="form-control" id="txtEquipNumber" name="equipment_number"readonly>

                          </div>
                          </div>
                      </div>

                      <!--DATE PREPARED-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">Date Prepared</span>
                              </div>
                              
                              <input type="text" class="form-control" name="date_prepared" id="txtCDatePrepared" readonly>

                          </div>
                          </div>
                      </div>    
                      
                      <!--Place to conduct JO-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">FACTORY CLASSIFICATION</span>
                              </div>
                              <input type="text" class="form-control" name="factory_classification" id="txtCFactoryClassification" readonly>
                          </div>
                          </div>
                      </div> 

                      <!--JOB DESCRIPTION-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">JOB DESCRIPTION</span>
                              </div>
                              <textarea class="form-control" id="txtCJoDescription" name="jo_description" rows="4" style="resize: none;" readonly></textarea> 
                          </div>
                          </div>
                      </div>   

                      <!--INITIAL ACTION-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">INITIAL ACTION</span>
                              </div>
                              
                              <textarea class="form-control" id="txtCInitialAction" name="initial_action" rows="4" style="resize: none;" readonly></textarea> 

                          </div>
                          </div>
                      </div> 
                      </div>          
                  </div>
                  
              {{-- CONFORMANCE DETAILS  --}}
              <div class="row">
                <div class="col-sm-6">
                    <h1 style="font-size: 1.2rem;"><b>Conformance Details (FAS)</b></h1>
                </div>          
            </div>   
              
            <div class="row">
                <div class="col-sm-6">     
        
                    <!--FAS Engineer Assigned-->
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">FAS Engineer Assigned:</span>
                                </div>
                                <select class="form-control sel-assign-fas" id="txtFasEngrAssigned" name="fas_engr_assigned">
                                    <option value="0">-- Assign Engineer --</option>
                                </select>
                            </div>
                        </div>
                    </div> 
        
                    <!--JO Classification.-->
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">Job Order Classification</span>
                            </div>
                                <select class="form-control" name="conformace_classification" id="txtFasClassification" disabled>
                                    <option value="0" selected disabled>-- Select Type --</option>
                                    <option value="1">Machine Repair and Troubleshooting</option>
                                    <option value="2">Machine/Equipment Modification</option>
                                    <option value="3">Machine/Equipment Development</option>
                                    <option value="4">Program/Software Development</option>
                                </select>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">Recommendation</span>
                                </div>
                                <div style="margin-left: 1rem;" class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="recommendation" id="txtRecommendation1" value="1" disabled>
                                        <label class="form-check-label" for="txtRecommendation1">
                                            Internal Job by FAS
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="recommendation" id="txtRecommendation2" value="2" disabled>
                                        <label class="form-check-label" for="txtRecommendation2">
                                            Need External Supplier
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="recommendation" id="txtRecommendation3" value="3" disabled>
                                        <label class="form-check-label" for="txtRecommendation3">
                                            Others
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-control-input" type="text" name="others_recommendation" id="txtOthersRecommendation" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>    
                
                <div class="col-sm-6">
                       <!--FAS Assessment-->
                       <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">FAS Assessment</span>
                                </div>
                                <textarea class="form-control" name="fas_assessment" id="txtFasAssessment" rows="3" style="resize: none;" readonly></textarea>
                            </div>
                        </div>
                      </div> 

                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">Estimated Completion Date</span>
                                </div>
                                <input  class="form-control" type="date" id="txtEstimatedCompletionDate" name="completion_date" readonly>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">Estimated Cost</span>
                                </div>

                                <select class="form-control" id="estimatedTypeId" name="estimated_type" disabled>
                                  <option value="0" selected disabled>-- Select Type --</option>
                                  <option value="1">$</option>
                                  <option value="2">PHP</option>
                                </select> 
            
                                <input type="number" class="form-control" id="txtEstimatedCost" name="estimated_cost" readonly>
                                {{-- <input class="form-control" type="text" name="estimated_cost" id="txtEstimatedCost" readonly> --}}
                            </div>
                        </div>
                    </div>
                    
                    <!--Remarks-->
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">Remarks</span>
                                </div>
                                <textarea class="form-control" name="conformance_remarks" id="txtFasRemarks" rows="3" style="resize: none;" readonly></textarea>
                            </div>
                        </div>
                    </div>  

                    <!--KTE Disconfirm Remarks-->
                    <div id="kteDisconfirmRemarksID" class="row" hidden>
                      <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">KTE Disconfirm Remarks</span>
                              </div>
                              <textarea class="form-control" name="kte_disconfirm_remarks" id="txtKTEDisconfirmRemarks" rows="3" style="resize: none;" readonly></textarea>
                          </div>
                      </div>
                    </div>  

                   <!--JCP Disconfirm Remarks-->
                   <div id="jcpDisconfirmRemarksID" class="row" hidden>
                      <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">JCP Disconfirm Remarks</span>
                              </div>
                              <textarea class="form-control" name="jcp_disconfirm_remarks" id="txtJCPDisconfirmRemarks" rows="3" style="resize: none;" readonly></textarea>
                          </div>
                      </div>
                    </div>  

                    <!--NCP Disconfirm Remarks-->
                   <div id="NCPDisconfirmRemarksID" class="row" hidden>
                    <div class="col">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend w-50">
                            <span class="input-group-text w-100" id="basic-addon1">NCP Disconfirm Remarks</span>
                            </div>
                            <textarea class="form-control" name="ncp_disconfirm_remarks" id="txtNCPDisconfirmRemarks" rows="3" style="resize: none;" readonly></textarea>
                        </div>
                    </div>
                  </div>  

                </div>
            </div>       
          </div> 

          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-danger mr-auto" id="btnDisconfirmRequest"><i id="ibtnDisconfirmRequest"></i> Disapprove Request</button>
              <button type="button" class="btn btn-sm btn-danger mr-auto" id="btnKTEDisconfirmRequest" hidden><i id="ibtnKTEDisconfirmRequest"></i> Disapprove Request</button>
              <button type="button" class="btn btn-sm btn-danger mr-auto" id="btnJCPDisconfirmRequest" hidden><i id="ibtnJCPDisconfirmRequest"></i> Disapprove Request</button>
              <button type="button" class="btn btn-sm btn-danger mr-auto" id="btnNCPDisconfirmRequest" hidden><i id="ibtnNCPDisconfirmRequest"></i> Disapprove Request</button>
              <button type="button" id="btnKTEConformanceButton" class="btn btn-primary" hidden><i id="ibtnKTEConformanceButtonIcon" class="fa fa-submit"></i> Conform</button>
              <button type="button" id="btnJCPConformanceButton" class="btn btn-primary" hidden><i id="ibtnJCPConformanceButtonIcon" class="fa fa-submit"></i> Conform</button>
              <button type="button" id="btnNCPConformanceButton" class="btn btn-primary" hidden><i id="ibtnNCPConformanceButtonIcon" class="fa fa-submit"></i> Conform</button>
              <button type="button" id="btnSubmitConformanceDetails" class="btn btn-primary" hidden><i id="ibtnSubmitConformanceDetailsIcon" class="fa fa-submit"></i> Submit</button>
          </div>
        </form>
      </div>
  </div>
</div>

<!--View Conformed Request-->
<div class="modal fade" id="modalViewCompleteRequest"  data-bs-backdrop="static">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">

      <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-eye"></i>Conformance Details</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form id="formViewCompleteRequest">
      @csrf
      <div class="modal-body">
          <div class="row">
              <div class="col-sm-12">
                  <label>Request Details</label>
              </div>
          </div>      
              <div class="row"></div>      
                  <div class="row">
                      <div class="col-sm-6">     
                          <!--JO NO.-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">Jo No.</span>
                              </div>

                              <input type="hidden" class="form-control" name="conform_request_id" id="conformRequestId" readonly>
                              <input type="hidden" class="form-control" name="jo_request_id" id="txtCompetedjoRequestId" readonly>
                              <input type="hidden" class="form-control" name="conformance_status" id="txtconformanceStatus" readonly>
                              <input type="text" class="form-control" name="generated_jo_no" id="txtCompetedJoNo" readonly>

                              </div>
                          </div>
                          </div>    
                      </div>
                      <div class="col-sm-6">

                      </div>
                      
                      <div class="col-sm-6">
                          <!--EQUIPMENT NAME-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">EQUIPMENT NAME</span>
                              </div>
                              
                              <input type="text" class="form-control" id="txtCompleteEquipName" name="equipment_name" readonly>

                              </div>
                          </div>
                          </div>

                          <!--REQUESTOR-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">Requestor</span>
                              </div>
                              <input type="hidden" class="form-control" name="requestor_id" id="txtCCompleteRequestorId" readonly>
                              <input type="text" class="form-control" name="requestor" id="txtCCompleteRequestor" readonly>
                              </div>
                          </div>
                          </div>

                          <!--DEPARTMENT-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">Department</span>
                              </div>
                              
                              <input type="text" class="form-control" name="department" id="txtCCompleteDepartment" readonly>

                              </div>
                          </div>
                          </div>

                      <!--ALLOCATED BUDGET-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">ALLOCATED BUDGET</span>
                              </div>

                              <input type="text" class="form-control" id="txtCCompleteBudgetType" name="allocated_budget_type" readonly>
                              <input type="text" class="form-control" id="txtCCompleteAllocatedBudget" name="allocated_budget" readonly>

                          </div>
                          </div>
                      </div>

                          <!--Attachment-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">Attachment</span>              
                              </div>    
                              <div class="input-group-prepend w-50">   
                                  {{-- <span class="input-group-text w-100" name="attachment" id="txtAttachmentFileName"></span>    --}}
                                  <input type="text" class="form-control" name="attachment" id="txtCCompleteAttachmentFileName" readonly>
                              </div>                        
                              </div>
                          </div>
                          </div>

                          <!--JO REQUEST CHECKER-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">CHECKER</span>
                              </div>                  
                              <input type="text" class="form-control sel-checked-by" name="jo_checker" id="txtCCompleteCheckedBy" readonly>
                              </div>
                          </div>
                          </div>

                          <!--JO REQUEST APPROVER-->
                          <div class="row">
                          <div class="col">
                              <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                                  <span class="input-group-text w-100" id="basic-addon1">Approver</span>
                              </div>                  
                              <!-- Conformed By -->
                              {{-- <input type="text" class="form-control" name="approver" id="txtCCompleteApprover" readonly> --}}
                              <!-- Conformed By -->
                              <input type="text" class="form-control sel-checked-by" name="jo_request_approver" id="txtCCompleteApproverName" readonly>
                              </div>
                          </div>
                          </div>

                      </div>

                      <div class="col-sm-6">
                      <!--EQUIPMENT NO-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">EQUIPMENT NUMBER</span>
                              </div>
                              
                              <input type="text" class="form-control sel-rapidx-section-heads" id="txtCompleteEquipNumber" name="equipment_number"readonly>

                          </div>
                          </div>
                      </div>

                      <!--DATE PREPARED-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">Date Prepared</span>
                              </div>
                              
                              <input type="text" class="form-control" name="date_prepared" id="txtCCompleteDatePrepared" readonly>

                          </div>
                          </div>
                      </div>    
                      
                      <!--Place to conduct JO-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">FACTORY CLASSIFICATION</span>
                              </div>
                              <input type="text" class="form-control" name="factory_classification" id="txtCCompleteFactoryClassification" readonly>
                          </div>
                          </div>
                      </div> 

                      <!--JOB DESCRIPTION-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">JOB DESCRIPTION</span>
                              </div>
                              <textarea class="form-control" id="txtCCompleteJoDescription" name="jo_description" rows="4" style="resize: none;" readonly></textarea> 
                          </div>
                          </div>
                      </div>   

                      <!--INITIAL ACTION-->
                      <div class="row">
                          <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">INITIAL ACTION</span>
                              </div>
                              
                              <textarea class="form-control" id="txtCCompleteInitialAction" name="initial_action" rows="4" style="resize: none;" readonly></textarea> 

                          </div>
                          </div>
                      </div> 
                      </div>          
                  </div>
                  
              {{-- CONFORMANCE DETAILS  --}}
              <div class="row">
                <div class="col-sm-6">
                    <h1 style="font-size: 1.2rem;"><b>Conformance Details (FAS)</b></h1>
                </div>          
            </div>   
              
            <div class="row">
                <div class="col-sm-6">     
        
                    <!--FAS Engineer Assigned-->
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">FAS Engineer Assigned:</span>
                                </div>
                                <select class="form-control sel-assign-fas" style="pointer-events: none;" id="txtCompleteFasEngrAssigned" name="fas_engr_assigned" readonly>
                                    <option value="0">-- Assign Engineer --</option>
                                </select>
                            </div>
                        </div>
                    </div> 
        
                    <!--JO Classification.-->
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">Job Order Classification</span>
                            </div>
                                <select class="form-control" name="conformace_classification" id="txtCompleteFasClassification" disabled>
                                    <option value="0" selected disabled>-- Select Type --</option>
                                    <option value="1">Machine Repair and Troubleshooting</option>
                                    <option value="2">Machine/Equipment Modification</option>
                                    <option value="3">Machine/Equipment Development</option>
                                    <option value="4">Program/Software Development</option>
                                </select>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">Recommendation</span>
                                </div>
                                <div style="margin-left: 1rem;" class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="recommendation" id="txtCompleteRecommendation1" value="1" disabled>
                                        <label class="form-check-label" for="txtCompleteRecommendation1">
                                            Internal Job by FAS
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="recommendation" id="txtCompleteRecommendation2" value="2" disabled>
                                        <label class="form-check-label" for="txtCompleteRecommendation2">
                                            Need External Supplier
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="recommendation" id="txtCompleteRecommendation3" value="3" disabled>
                                        <label class="form-check-label" for="txtCompleteRecommendation3">
                                            Others
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-control-input" type="text" name="others_recommendation" id="txtCompleteOthersRecommendation" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>    
                
                <div class="col-sm-6">
                       <!--FAS Assessment-->
                       <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">FAS Assessment</span>
                                </div>
                                <textarea class="form-control" name="fas_assessment" id="txtCompleteFasAssessment" rows="3" style="resize: none;" readonly></textarea>
                            </div>
                        </div>
                      </div> 

                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">Estimated Completion Date</span>
                                </div>
                                <input  class="form-control" type="date" id="txtCompleteEstimatedCompletionDate" name="completion_date" readonly>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">Estimated Cost</span>
                                </div>

                                <select class="form-control" id="txtCompleteEstimatedTypeId" name="estimated_type" readonly>
                                  <option value="0" selected disabled>-- Select Type --</option>
                                  <option value="1">$</option>
                                  <option value="2">PHP</option>
                                </select> 
            
                                <input type="number" class="form-control" id="txtCompleteEstimatedCost" name="estimated_cost" readonly>
                                {{-- <input class="form-control" type="text" name="estimated_cost" id="txtEstimatedCost" readonly> --}}
                            </div>
                        </div>
                    </div>
                    
                    <!--Remarks-->
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text w-100" id="basic-addon1">Remarks</span>
                                </div>
                                <textarea class="form-control" name="conformance_remarks" id="txtCompleteFasRemarks" rows="3" style="resize: none;" readonly></textarea>
                            </div>
                        </div>
                    </div>  

                    <!--KTE Disconfirm Remarks-->
                    <div id="kteCompletedDisconfirmRemarksID" class="row" hidden>
                      <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">KTE Disconfirm Remarks</span>
                              </div>
                              <textarea class="form-control" name="kte_disconfirm_remarks" id="txtCompleteKTEDisconfirmRemarks" rows="3" style="resize: none;" readonly></textarea>
                          </div>
                      </div>
                    </div>  

                   <!--JCP Disconfirm Remarks-->
                   <div id="jcpCompletedDisconfirmRemarksID" class="row" hidden>
                      <div class="col">
                          <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend w-50">
                              <span class="input-group-text w-100" id="basic-addon1">JCP Disconfirm Remarks</span>
                              </div>
                              <textarea class="form-control" name="jcp_disconfirm_remarks" id="txtCompleteJCPDisconfirmRemarks" rows="3" style="resize: none;" readonly></textarea>
                          </div>
                      </div>
                    </div>  

                    <!--NCP Disconfirm Remarks-->
                   <div id="NCPCompletedDisconfirmRemarksID" class="row" hidden>
                    <div class="col">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend w-50">
                            <span class="input-group-text w-100" id="basic-addon1">NCP Disconfirm Remarks</span>
                            </div>
                            <textarea class="form-control" name="ncp_disconfirm_remarks" id="txtCompleteNCPDisconfirmRemarks" rows="3" style="resize: none;" readonly></textarea>
                        </div>
                    </div>
                  </div>  

                </div>
            </div>       
          </div> 
        </form>
      </div>
  </div>
</div>

@endsection

@section('js_content')
<script type="text/javascript">
  $(document).ready(function(){

    dt_jo_requests = $('#tbl_JO_Requests').DataTable({
        "processing" : true,
        "serverSide" : true,
        "ajax" : {
          url: "view_request_details",
          data: function (param){

          }
        },

        "columns":[

          { "data" : "action" },
          { "data" : "status" },
          { "data" : "conformance_status" },
          { "data" : "jo_ctrl_no" },
          { "data" : "job_description" },
          { "data" : "initial_action" },
          { "data" : "attachment" },
          // { "data" : "department" },
          { "data" : "prepared_by" },
          { "data" : "jo_classification"},
          { "data" : "fas_assessment"},
          { "data" : "est_date"},
          { "data" : "assessed_by"},
          // { "data" : "action", orderable:false, searchable:false },
          
        ],
    });

    $('#btnNewJORequest').click(function(){

      toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
      };
      $.ajax({

      url: "get_jo_records",
      method: "get",
      data:
      {

      },
      dataType: "json",
      beforeSend: function()
      {

      },
      success: function(JsonObject)
      {
        if(JsonObject['result'] == 1)
        {
          let requestorId = JsonObject['user'][0].id;
          let requestor = JsonObject['user'][0].name;
          let department = JsonObject['user'][0].department_details.department_group;
          let jo_request_ctrlno = JsonObject['jo_request_control_number'];

          $('#add_requestor_id').val(requestorId);
          $('#add_requestor').val(requestor);
          $('#add_department').val(department);  
          $('#generated_jo_no').val(jo_request_ctrlno);          
        }
      },
      error: function(data, xhr, status){
          toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
      }

      });

      $(".show_upload_attachment").removeClass('d-none');
      $(".show_checkbox").addClass('d-none');
      $(".show_attachment").addClass('d-none');

      LoadRapidXUserListSectionHead($('.sel-rapidx-section-heads'));
      loadKakampinkDetails($('.sel-checked-by'));
      
    });

    $('#add_attachment').prop( "disabled", true );

    $('#add_jo_request_type').change(function() {      
        if ( $(this).val() == 1){       
            $('#add_attachment').prop( "disabled", true );
        }else {       
            $('#add_attachment').prop( "disabled", false );
        }
    })

     //Add JO Request 
     $("#formAddJORequest").submit(function(event){
      // $('#add_date_needed').attr('min', maxDate);

      event.preventDefault();
      AddJORequest();
    });
    
    // Get Ongoing Request details by ID
    $(document).on('click', '.btn-view-jo-details', function(e){
      e.preventDefault();
      $('#modalNewJORequest').modal('show');
      let requestId = $(this).attr('requests-id');
      let requestStatus = $(this).attr('requests-status');
      $("#requestId").val(requestId);

        $('#txtFasEngrAssigned').prop('disabled', true);
        $('#txtFasClassification').prop('disabled', true);
        $('#txtRecommendation1').prop('disabled', true);
        $('#txtRecommendation2').prop('disabled', true);
        $('#txtRecommendation3').prop('disabled', true);
        $('#txtEstimatedCompletionDate').prop('readonly', true);
        $('#txtEstimatedCost').prop('readonly', true);
        $('#txtFasRemarks').prop('readonly', true);

        $('#check_box').removeAttr('hidden');
        $('#labelId').removeAttr('hidden');

      if(requestStatus >= 1){
        $('#btnSubmitJORequest').prop('disabled', true);
        $('#check_box').prop('disabled', true);
      }else{
        $('#btnSubmitJORequest').prop('disabled', false);

      }

      getJORequestDetailsToEdit(requestId);
      LoadRapidXUserListSectionHead($('.sel-rapidx-section-heads'));
      loadKakampinkDetails($('.sel-checked-by'));
    });

    $('#modalNewJORequest').on('hide.bs.modal', function() {
        $('#check_box').attr('checked', false);
        $(this).find('form').trigger('reset');
        // alert('modal closed');
        // window.location.reload();
    });

    $(document).on('click', '.btn-checked-requests', function(e){
      e.preventDefault();
      let chkRequestId = $(this).attr('requests-id');
      // console.log(chkRequestId);
      $("#txtRequestCheckId").val(chkRequestId);
      getJORequestDetailsToCheck(chkRequestId);
      // alert('heeey');
    });

    $('#btnCheckedRequest').click(function(){
      let chkvalue = $(this).attr('chkvalue');
      // console.log('chkvalue', chkvalue);
      Swal.fire({
          title: 'Are you sure you want to APPROVE the request?',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Yes, APPROVE!'
        }).then((result) => {
          if (result.isConfirmed) {
            // alert('save');
            $('#txtCheckedStatus').val(chkvalue);
            $('#formCheckedJORequest').submit();

          }
        });

    });

    $("#formCheckedJORequest").submit(function(event){
      event.preventDefault();
      CheckedJoRequest();
    });    

    $(document).on('click', '.btn-approve-requests', function(e){
      e.preventDefault();
      let requestId = $(this).attr('requests-id');
      $("#txtRequestId").val(requestId);
      getJORequestDetailsToApprove(requestId);
      // alert('heeey');
    });

    $('#btnApprovedRequest').click(function(){
      let apprvValue = $(this).attr('apprvValue');
      // console.log('apprvValue', apprvValue);
      Swal.fire({
          title: 'Are you sure you want to APPROVE the request?',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Yes, APPROVE!'
        }).then((result) => {
          if (result.isConfirmed) {
            // console.log('confirmed');
            $('#txtApprovalStatus').val(apprvValue);
            $('#formApprovedJORequest').submit();

          }
        });

    });

    $("#formApprovedJORequest").submit(function(event){
      event.preventDefault();
      // console.log('submitted');
      // alert('heeere');
      ApprovedJoRequest();
    }); 

    $(document).on('click', '.btn-conform-requests', function(e){
        e.preventDefault();
        $('#modalConformRequest').modal('show');
        let requestId = $(this).attr('requests-id');
        // let conformanceId = $(this).attr('conformance-id');
        
        loadFasEngineers($('.sel-assign-fas'));
        LoadRapidXUserListSectionHead($('.sel-rapidx-section-heads'));
        loadKakampinkDetails($('.sel-checked-by'));
        getJORequestDetailsToConform(requestId);
        getJoRequestConformanceDetails(requestId);

        $('#add_equipment_name').prop('readonly', true);
        $('#add_equipment_number').prop('readonly', true);
        $('#add_jo_description').prop('readonly', true);
        $('#add_initial_action').prop('readonly', true);
        $('#add_factory').prop('disabled', true);
        $('#add_jo_request_checker').prop('disabled', true);
        $('#add_jo_request_approver').prop('disabled', true);
        $('#add_jo_request_type').prop('disabled', true);
        $('#add_budget_type').prop('disabled', true);
        $('#add_allocated_budget').prop('readonly', true);
        $('#check_box').prop('hidden', true);
        $('#labelId').prop('hidden', true);
        $('#btnSubmitJORequest').prop('hidden', true);
        
        $('#joRequestId').val(requestId);


        setTimeout(() => {
          let conformanceStatus = $('#txtconformanceStatus').val();
          // console.log(conformanceStatus);
          if(conformanceStatus == '' || conformanceStatus == 0){
            console.log('ASSIGN ENGINEER');
            $('#btnSubmitConformanceDetails').prop('hidden', false);
            $('#btnDisconfirmRequest').prop('disabled', true);
            // $('#btnKTEDisconfirmRequest').prop('disabled', true);
            // $('#btnJCPDisconfirmRequest').prop('disabled', true);
            // $('#btnNCPDisconfirmRequest').prop('disabled', true);

          }
          else if(conformanceStatus == 1){
            // console.log('KTE');
            $('#btnSubmitConformanceDetails').prop('hidden', true);
            $('#btnJCPConformanceButton').prop('hidden', true);
            $('#btnNCPConformanceButton').prop('hidden', true);
            $('#btnKTEConformanceButton').prop('hidden', false);

            //Disconfirm BUTTON
            $('#btnDisconfirmRequest').prop('hidden', true);
            $('#btnKTEDisconfirmRequest').prop('hidden', false);
          }
          else if(conformanceStatus == 2){
            // console.log('JCP');
            $('#btnSubmitConformanceDetails').prop('hidden', true);
            $('#btnKTEConformanceButton').prop('hidden', true);
            $('#btnNCPConformanceButton').prop('hidden', true);
            $('#btnJCPConformanceButton').prop('hidden', false);
            $('#btnJCPDisconfirmRequest').prop('hidden', false);
            $('#btnDisconfirmRequest').prop('hidden', true);
          }else if(conformanceStatus == 3){
            // console.log('NCP');
            $('#btnSubmitConformanceDetails').prop('hidden', true);
            $('#btnDisconfirmRequest').prop('hidden', true);
            $('#btnKTEConformanceButton').prop('hidden', true);
            $('#btnJCPConformanceButton').prop('hidden', true);
            $('#btnNCPConformanceButton').prop('hidden', false);
            $('#btnNCPDisconfirmRequest').prop('hidden', false);
          }else if(conformanceStatus == 5 || conformanceStatus == 6){
            // console.log('DISCONFIRM FOR ASSIGN ENGINEER TO EDIT');
            $('#btnSubmitConformanceDetails').prop('hidden', false);
            // $('#kteDisconfirmRemarksID').prop('hidden', false);
            $('#btnDisconfirmRequest').prop('disabled', true);
            // $('#btnKTEDisconfirmRequest').prop('disabled', true);
            // $('#btnJCPDisconfirmRequest').prop('disabled', true);
            // $('#btnNCPDisconfirmRequest').prop('disabled', true);

          }
        }, 700);
        
        $('input[type="radio"][name="recommendation"]').change(function() {
           
            var selectedValue = $(this).val();
            
            if(selectedValue == 3){
                $('#txtOthersRecommendation').removeAttr('readonly');
            }else{
                $('#txtOthersRecommendation').prop('readonly', true);
                $('#txtOthersRecommendation').val('');
            }
      
        })
    });
     //Conformance

     // Approve Request (FAS Side)
    $('#btnSubmitConformanceDetails').click(function(){
        $('#formConformRequest').submit();
    });

    $("#formConformRequest").submit(function(event){
      event.preventDefault();
      // console.log('heasd');
      AddConformanceDetails();
      // AssignedEngr();
    });   
    
    // KTE CONFORMANCE
    $('#btnKTEConformanceButton').click(function(){
      conformanceId = $('#conformRequestId').val();
      Swal.fire({
            title: 'Are you sure you want to CONFORM the request?',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, CONFORM!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  type: "get",
                  url: "conformance_by_kte",
                  data: {
                    conformance_id: conformanceId
                  },
                  dataType: "json",
                  success: function (response) {
                    if(response['result'] == 1){
                      $("#modalConformRequest").modal('hide');
                      $("#formConformRequest")[0].reset();        

                      // console.log('success');
                      dt_jo_requests.draw();
                      toastr.success('Request succesfully saved!');       
                    }
                  },
                  error: function(data, xhr, status){
                    toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
                    $("#ibtnKTEConformanceButtonIcon").removeClass('fa fa-spinner fa-pulse');
                    $("#btnKTEConformanceButton").removeAttr('disabled');
                    $("#ibtnKTEConformanceButtonIcon").addClass('fa fa-upload');
                  }
              });
            }
          });
    });

    $('#btnKTEDisconfirmRequest').click(function(){
      conformanceId = $('#conformRequestId').val();
      Swal.fire({
          title: 'Are you sure you want to DISCONFIRM the request?',
          html: `<input id="swal-input" class="swal2-input" placeholder="Enter reason for disconfirming" autocomplete="off">`, // Disable autocomplete
          focusConfirm: false,
          showCancelButton: true,
          confirmButtonColor: '#FF0000',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Yes, Disconfirm !',
        }).then((result) => {
          if (result.isConfirmed) {
            const reason = document.getElementById('swal-input').value; // Get the input value
            $.ajax({
              type: "get",
              url: "disconformance_by_kte",
              data: {
                conformance_id: conformanceId,
                reason: reason // Send reason with the request
              },
              dataType: "json",
              success: function (response) {
                if (response['result'] == 1) {
                  $("#modalConformRequest").modal('hide');
                  $("#formConformRequest")[0].reset();
                  dt_jo_requests.draw();
                  toastr.success('Request successfully saved!');
                }
              },
              error: function (data, xhr, status) {
                toastr.error('An error occurred!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
                $("#ibtnKTEConformanceButtonIcon").removeClass('fa fa-spinner fa-pulse');
                $("#btnKTEConformanceButton").removeAttr('disabled');
                $("#ibtnKTEConformanceButtonIcon").addClass('fa fa-upload');
              }
            });
          }
        });
    });
    // END OF KTE CONFORMANCE

    //JCP CONFORMANCESS
    $('#btnJCPConformanceButton').click(function(){
      conformanceId = $('#conformRequestId').val();
      Swal.fire({
            title: 'Are you sure you want to CONFORM the request?',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, CONFORM!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  type: "get",
                  url: "conformance_by_jcp",
                  data: {
                    conformance_id: conformanceId
                  },
                  dataType: "json",
                  success: function (response) {
                    if(response['result'] == 1){
                      $("#modalConformRequest").modal('hide');
                      $("#formConformRequest")[0].reset();        
                      dt_jo_requests.draw();
                      toastr.success('Request succesfully saved!');       
                    }
                  },
                  error: function(data, xhr, status){
                    toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
                    $("#ibtnJCPConformanceButtonIcon").removeClass('fa fa-spinner fa-pulse');
                    $("#btnJCPConformanceButton").removeAttr('disabled');
                    $("#ibtnJCPConformanceButtonIcon").addClass('fa fa-upload');
                  }
              });
            }
          });
    });

    $('#btnJCPDisconfirmRequest').click(function(){
      conformanceId = $('#conformRequestId').val();
      Swal.fire({
          title: 'Are you sure you want to DISCONFIRM the request?',
          html: `<input id="swal-input" class="swal2-input" placeholder="Enter reason for disconfirming" autocomplete="off">`, // Disable autocomplete
          focusConfirm: false,
          showCancelButton: true,
          confirmButtonColor: '#FF0000',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Yes, Disconfirm !',
        }).then((result) => {
          if (result.isConfirmed) {
            const reason = document.getElementById('swal-input').value; // Get the input value
            $.ajax({
              type: "get",
              url: "disconformance_by_jcp",
              data: {
                conformance_id: conformanceId,
                reason: reason // Send reason with the request
              },
              dataType: "json",
              success: function (response) {
                if (response['result'] == 1) {
                  $("#modalConformRequest").modal('hide');
                  $("#formConformRequest")[0].reset();
                  dt_jo_requests.draw();
                  toastr.success('Request successfully saved!');
                }
              },
              error: function (data, xhr, status) {
                toastr.error('An error occurred!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
                $("#ibtnJCPDisconfirmRequest").removeClass('fa fa-spinner fa-pulse');
                $("#btnJCPDisconfirmRequest").removeAttr('disabled');
                $("#ibtnJCPDisconfirmRequest").addClass('fa fa-upload');
              }
            });
          }
        });
    });
    // END OF JCP CONFORMANCE

        //NCP CONFORMANCESS
    $('#btnNCPConformanceButton').click(function(){
      conformanceId = $('#conformRequestId').val();
      Swal.fire({
            title: 'Are you sure you want to CONFORM the request?',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, CONFORM!'
          }).then((result) => {
            if (result.isConfirmed) {
              // alert('here');
              $.ajax({
                  type: "get",
                  url: "conformance_by_ncp",
                  data: {
                    conformance_id: conformanceId
                  },
                  dataType: "json",
                  success: function (response) {
                    if(response['result'] == 1){
                      $("#modalConformRequest").modal('hide');
                      $("#formConformRequest")[0].reset();        

                      // console.log('success');
                      dt_jo_requests.draw();
                      toastr.success('Request succesfully saved!');       
                    }
                  },
                  error: function(data, xhr, status){
                    toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
                    $("#ibtnNCPConformanceButtonIcon").removeClass('fa fa-spinner fa-pulse');
                    $("#btnNCPConformanceButton").removeAttr('disabled');
                    $("#ibtnNCPConformanceButtonIcon").addClass('fa fa-upload');
                  }
              });
            }
          });
    });

    $('#btnNCPDisconfirmRequest').click(function(){
      conformanceId = $('#conformRequestId').val();
      Swal.fire({
          title: 'Are you sure you want to DISCONFIRM the request?',
          html: `<input id="swal-input" class="swal2-input" placeholder="Enter reason for disconfirming" autocomplete="off">`, // Disable autocomplete
          focusConfirm: false,
          showCancelButton: true,
          confirmButtonColor: '#FF0000',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Yes, Disconfirm !',
        }).then((result) => {
          if (result.isConfirmed) {
            const reason = document.getElementById('swal-input').value; // Get the input value
            $.ajax({
              type: "get",
              url: "disconformance_by_ncp",
              data: {
                conformance_id: conformanceId,
                reason: reason // Send reason with the request
              },
              dataType: "json",
              success: function (response) {
                if (response['result'] == 1) {
                  $("#modalConformRequest").modal('hide');
                  $("#formConformRequest")[0].reset();
                  dt_jo_requests.draw();
                  toastr.success('Request successfully saved!');
                }
              },
              error: function (data, xhr, status) {
                toastr.error('An error occurred!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
                $("#ibtnNCPDisconfirmRequest").removeClass('fa fa-spinner fa-pulse');
                $("#btnNCPDisconfirmRequest").removeAttr('disabled');
                $("#ibtnNCPDisconfirmRequest").addClass('fa fa-upload');
              }
            });
          }
        });
    });
    // END OF NCP CONFORMANCE

    $(document).on('click', '.btn-complete-requests', function(e){
      let requestId = $(this).attr('requests-id');
      // console.log(requestId);
      Swal.fire({
            title: 'Are you sure you want to COMPLETE the request?',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, COMPLETE!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  type: "get",
                  url: "complete_jo_request",
                  data: {
                    request_id: requestId
                  },
                  dataType: "json",
                  success: function (response) {
                    if(response['result'] == 1){
                      $("#modalConformRequest").modal('hide');
                      $("#formConformRequest")[0].reset();        
                      dt_jo_requests.draw();
                      toastr.success('Request succesfully saved!');       
                    }
                  },
                  error: function(data, xhr, status){
                    toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
                  }
              });
            }
          });
    });

    $(document).on('click', '.btn-checkedtoComplete-requests', function(e){
      let requestId = $(this).attr('requests-id');
      // console.log(requestId);
      Swal.fire({
            title: 'Are you sure you want to COMPLETE the request?',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, COMPLETE!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  type: "get",
                  url: "checked_jo_request_completion",
                  data: {
                    request_id: requestId
                  },
                  dataType: "json",
                  success: function (response) {
                    if(response['result'] == 1){
                      // $("#modalConformRequest").modal('hide');
                      // $("#formConformRequest")[0].reset();        
                      dt_jo_requests.draw();
                      toastr.success('Request succesfully saved!');       
                    }
                  },
                  error: function(data, xhr, status){
                    toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
                  }
              });
            }
          });
    });
    
    $(document).on('click', '.btn-apprvToComplete-requests', function(e){
      let requestId = $(this).attr('requests-id');
      // console.log(requestId);
      Swal.fire({
            title: 'Are you sure you want to COMPLETE the request?',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, COMPLETE!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  type: "get",
                  url: "approved_jo_to_complete",
                  data: {
                    request_id: requestId
                  },
                  dataType: "json",
                  success: function (response) {
                    if(response['result'] == 1){
                      // $("#modalConformRequest").modal('hide');
                      // $("#formConformRequest")[0].reset();        
                      dt_jo_requests.draw();
                      toastr.success('Request succesfully saved!');       
                    }
                  },
                  error: function(data, xhr, status){
                    toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
                  }
              });
            }
          });
    });

    $(document).on('click', '.btn-conformToComplete-requests', function(e){
      let requestId = $(this).attr('requests-id');
      // console.log(requestId);
      Swal.fire({
          title: 'Are you sure you want to CONFIRM the request?',
          html: `<input id="swal-input" class="swal2-input" placeholder="Enter remarks" autocomplete="off">`, // Disable autocomplete
          focusConfirm: false,
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Yes, CONFIRM !',
        }).then((result) => {
          if (result.isConfirmed) {
            const remarks = document.getElementById('swal-input').value; // Get the input value
            $.ajax({
              type: "get",
              url: "conformance_to_complete",
              data: {
                request_id: requestId,
                remarks: remarks // Send reason with the request
              },
              dataType: "json",
              success: function (response) {
                if (response['result'] == 1) {
                  $("#modalConformRequest").modal('hide');
                  $("#formConformRequest")[0].reset();
                  dt_jo_requests.draw();
                  toastr.success('Request successfully saved!');
                }
              },
              error: function (data, xhr, status) {
                toastr.error('An error occurred!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
              }
            });
          }else{
            // alert('wala');
          }
        });
      });

      $(document).on('click', '.btn-viewComplete-requests', function(e){
        // alert('viewing');;
        let requestID = $(this).attr('requests-id');

        console.log('requestID', requestID);

        getDataOfCompletedJORequest(requestID);
        LoadRapidXUserListSectionHead($('.sel-rapidx-section-heads'));
        loadKakampinkDetails($('.sel-checked-by'));
        loadFasEngineers($('.sel-assign-fas'));

      });

      $('#modalAddUser').on('hidden.bs.modal', function() {
      // Reset the form fields
          $('#formViewCompleteRequest')[0].reset();
          
          // Optionally, clear other dynamic elements or states
          // For example, if you have select elements, you can reset them:
          // $('#yourSelectElement').val('').trigger('change');
      });

      $(document).on('click', '.btn-downloadPdf-requests', function(e){
        e.preventDefault();
        console.log('click');
        let requestID = $(this).attr('requests-id');
        window.location.href = `download_jo_request_details_pdf/${requestID}`;
      });

  });
</script>
@endsection