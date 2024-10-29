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
        <h1>Job Order Requests For Conformance</h1>
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
                {{-- <button type="button" class="btn btn-sm btn-success" id="btnNewJORequest" data-bs-toggle="modal" data-bs-target="#modalNewJORequest"><i class="fa fa-plus"></i> New JO Request</button> --}}
            </div>
            </div>
            <!-- Start Page Content -->
            <div class="card-body">
        
            <div class="dt-responsive table-responsive">
                <table id="tblJoRequestForConformance" class="table table-striped table-bordered" style="width: 100%; font-size: 90%;">
                <thead>
                    <tr>
                    <th>Action</th>                            
                    <th>Request Status</th>
                    <th>Control Number</th>
                    <th>Job Description</th>    
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

<!--View Conformed Request-->
<div class="modal fade" id="modalConformRequest"  data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title"><i class="fa fa-eye"></i>Job Order Request Details</h4>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="formConformRequest">
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

                                <input type="hidden" class="form-control" name="conformRequestId" id="txtRequestId" readonly>
                                <input type="hidden" class="form-control" name="status" id="txtStatus" readonly>
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
                                <input type="hidden" class="form-control" name="requestor_id" id="txtRequestorId" readonly>
                                <input type="text" class="form-control" name="requestor" id="txtRequestor" readonly>
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
                                
                                <input type="text" class="form-control" name="department" id="txtDepartment" readonly>

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

                                <input type="text" class="form-control" id="txtBudgetType" name="allocated_budget_type" readonly>
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
                                <input type="hidden" class="form-control" name="approver" id="txtApprover" readonly>
                                <!-- Conformed By -->
                                <input type="text" class="form-control" name="jo_request_approver" id="txtApproverName" readonly>
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
                    
                    CONFORMANCE DETAILS 
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
                                        <option value="0" selected disabled>-- Assign Engineer --</option>
                                    </select>
                                </div>
                            </div>
                        </div> 

                        <!--JO NO.-->
                        <div class="row">
                            <div class="col">
                                <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text w-100" id="basic-addon1">Job Order Classification</span>
                                </div>
                                    <select class="form-control" name="conformace_classification" id="txtanceClassification">
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
                                            <input class="form-check-input" type="radio" name="recommendation" id="txtRecommendation1" value="1">
                                            <label class="form-check-label" for="txtRecommendation1">
                                                Internal Job by FAS
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="recommendation" id="txtRecommendation2" value="2">
                                            <label class="form-check-label" for="txtRecommendation2">
                                                Need External Supplier
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="recommendation" id="txtRecommendation3" value="3">
                                            <label class="form-check-label" for="txtRecommendation3">
                                                Others
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-control-input" type="text" name="others_recommendation" id="txtOthersRecommendation" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>    
                    
                    <div class="col-sm-6">

                        <div class="row">
                            <div class="col">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend w-50">
                                    <span class="input-group-text w-100" id="basic-addon1">Estimated Completion Date</span>
                                    </div>
                                    <input  class="form-control" type="date" id="txtEstimatedCompletionDate" name="completion_date">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend w-50">
                                    <span class="input-group-text w-100" id="basic-addon1">Estimated Cost</span>
                                    </div>
                                    <input class="form-control" type="text" name="estimated_cost" id="txtEstimatedCost">
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
                                    <textarea class="form-control" name="conformance_remarks" id="txtanceRemarks" rows="3" style="resize: none;"></textarea>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>         
            </div> 

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-sm btn-danger mr-auto" id="btnDisconformRequest"><i id="ibtnDisconformRequest"></i> Disapprove Request</button>

                <button type="button" class="btn btn-sm btn-success" id="btnConformJoDetails"><i id="ibtnConformJoDetailsIcon"></i> Conform</button>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js_content')
<script type="text/javascript">
    $(document).ready(function(){

        dtJoRequestForConformance = $('#tblJoRequestForConformance').DataTable({
            "processing" : true,
            "serverSide" : true,
            "ajax" : {
            url: "view_requests_for_conformance",
            data: function (param){
            }
            },

            "columns":[

            { "data" : "action" },
            { "data" : "status" },
            { "data" : "jo_ctrl_no" },
            { "data" : "job_description" },
            { "data" : "jo_classification" },
            { "data" : "fas_assessment" },
            { "data" : "est_date" },
            { "data" : "assessed_by" },
            
            ],
        });

        $(document).on('click', '.btn-conform-requests', function(e){
            e.preventDefault();
            $('#modalConformRequest').modal('show');
            let requestId = $(this).attr('requests-id');
            // console.log(requestId);
            loadFasEngineers($('.sel-assign-fas'));
            getJORequestDetailsToConform(requestId);
        });

        $('input[type="radio"][name="recommendation"]').change(function() {
            
            var selectedValue = $(this).val();
            
            if(selectedValue == 3){
                $('#txtOthersRecommendation').removeAttr('disabled');
            }else{
                $('#txtOthersRecommendation').prop('disabled', true);
            }

        });


    });
</script>
@endsection