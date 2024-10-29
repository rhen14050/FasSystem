function AddJORequest(){
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

    let form_data = new FormData($('#formAddJORequest')[0]);

    $.ajax({
        url: "add_jo_request",
        method: "post",
        processData: false,
        contentType: false,
        data: form_data,
        dataType: "json",
        beforeSend: function(){
            $("#ibtnSubmitJORequestDefIcon").removeClass('fa fa-upload')
            $("#ibtnSubmitJORequestDefIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnSubmitJORequest").prop('disabled', 'disabled');
        },
        success: function(JsonObject){

            $("#ibtnSubmitJORequestDefIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnSubmitJORequest").removeAttr('disabled');
            $("#ibtnSubmitJORequestDefIcon").addClass('fa fa-upload');

            if(JsonObject['result'] == 1){
              $("#modalNewJORequest").modal('hide');
              $("#formAddJORequest")[0].reset();

              $("#generated_jo_no").removeClass('is-invalid');
              $("#add_requestor_id").removeClass('is-invalid');
              $("#add_requestor").removeClass('is-invalid');
              $("#add_department").removeClass('is-invalid');
              $("#add_jo_request_approver").removeClass('is-invalid');
              $("#add_jo_request_type").removeClass('is-invalid');
              $("#add_date_prepared").removeClass('is-invalid');
              $("#add_date_needed").removeClass('is-invalid');
              

          	  dt_jo_requests.draw();
              toastr.success('Request succesfully saved!');       
            }
            else{
                toastr.error(' Saving Request Failed!');

                if(JsonObject['error']['jo_no'] === undefined){
                    $("#generated_jo_no").removeClass('is-invalid');
                    $("#generated_jo_no").attr('title', '');
                }
                else{
                    $("#generated_jo_no").addClass('is-invalid');
                    $("#generated_jo_no").attr('title', JsonObject['error']['jo_no']);
                }

                if(JsonObject['error']['requestor_id'] === undefined){
                    $("#add_requestor_id").removeClass('is-invalid');
                    $("#add_requestor_id").attr('title', '');
                }
                else{
                    $("#add_requestor_id").addClass('is-invalid');
                    $("#add_requestor_id").attr('title', JsonObject['error']['requestor_id']);
                } 

                if(JsonObject['error']['requestor'] === undefined){
                    $("#add_requestor").removeClass('is-invalid');
                    $("#add_requestor").attr('title', '');
                }
                else{
                    $("#add_requestor").addClass('is-invalid');
                    $("#add_requestor").attr('title', JsonObject['error']['requestor']);
                } 

                if(JsonObject['error']['department'] === undefined){
                    $("#add_department").removeClass('is-invalid');
                    $("#add_department").attr('title', '');
                }
                else{
                    $("#add_department").addClass('is-invalid');
                    $("#add_department").attr('title', JsonObject['error']['department']);
                }

                if(JsonObject['error']['jo_request_approver'] === undefined){
                    $("#add_jo_request_approver").removeClass('is-invalid');
                    $("#add_jo_request_approver").attr('title', '');
                }
                else{
                    $("#add_jo_request_approver").addClass('is-invalid');
                    $("#add_jo_request_approver").attr('title', JsonObject['error']['jo_request_approver']);
                }
                
                if(JsonObject['error']['jo_request_checker'] === undefined){
                    $("#add_jo_request_checker").removeClass('is-invalid');
                    $("#add_jo_request_checker").attr('title', '');
                }
                else{
                    $("#add_jo_request_checker").addClass('is-invalid');
                    $("#add_jo_request_checker").attr('title', JsonObject['error']['jo_request_checker']);
                } 

                if(JsonObject['error']['jo_request_type'] === undefined){
                    $("#add_jo_request_type").removeClass('is-invalid');
                    $("#add_jo_request_type").attr('title', '');
                }
                else{
                    $("#add_jo_request_type").addClass('is-invalid');
                    $("#add_jo_request_type").attr('title', JsonObject['error']['jo_request_type']);
                }       
                
                if(JsonObject['error']['date_prepared'] === undefined){
                    $("#add_date_prepared").removeClass('is-invalid');
                    $("#add_date_prepared").attr('title', '');
                }
                else{
                    $("#add_date_prepared").addClass('is-invalid');
                    $("#add_date_prepared").attr('title', JsonObject['error']['date_prepared']);
                }
                
                if(JsonObject['error']['jo_description'] === undefined){
                    $("#add_jo_description").removeClass('is-invalid');
                    $("#add_jo_description").attr('title', '');
                }
                else{
                    $("#add_jo_description").addClass('is-invalid');
                    $("#add_jo_description").attr('title', JsonObject['error']['jo_description']);
                }

                if(JsonObject['error']['initial_action'] === undefined){
                    $("#add_initial_action").removeClass('is-invalid');
                    $("#add_initial_action").attr('title', '');
                }
                else{
                    $("#add_initial_action").addClass('is-invalid');
                    $("#add_initial_action").attr('title', JsonObject['error']['initial_action']);
                }
                
                if(JsonObject['error']['equipment_name'] === undefined){
                    $("#add_equipment_name").removeClass('is-invalid');
                    $("#add_equipment_name").attr('title', '');
                }
                else{
                    $("#add_equipment_name").addClass('is-invalid');
                    $("#add_equipment_name").attr('title', JsonObject['error']['equipment_name']);
                }

                if(JsonObject['error']['equipment_number'] === undefined){
                    $("#add_equipment_number").removeClass('is-invalid');
                    $("#add_equipment_number").attr('title', '');
                }
                else{
                    $("#add_equipment_number").addClass('is-invalid');
                    $("#add_equipment_number").attr('title', JsonObject['error']['equipment_number']);
                }

                if(JsonObject['error']['budget_type'] === undefined){
                    $("#add_budget_type").removeClass('is-invalid');
                    $("#add_budget_type").attr('title', '');
                }
                else{
                    $("#add_budget_type").addClass('is-invalid');
                    $("#add_budget_type").attr('title', JsonObject['error']['budget_type']);
                }

                if(JsonObject['error']['allocated_budget'] === undefined){
                    $("#add_allocated_budget").removeClass('is-invalid');
                    $("#add_allocated_budget").attr('title', '');
                }
                else{
                    $("#add_allocated_budget").addClass('is-invalid');
                    $("#add_allocated_budget").attr('title', JsonObject['error']['allocated_budget']);
                }

                if(JsonObject['error']['factory_classification'] === undefined){
                    $("#add_factory").removeClass('is-invalid');
                    $("#add_factory").attr('title', '');
                }
                else{
                    $("#add_factory").addClass('is-invalid');
                    $("#add_factory").attr('title', JsonObject['error']['factory_classification']);
                }
            }

        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
            $("#ibtnSubmitJORequestDefIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnSubmitJORequest").removeAttr('disabled');
            $("#ibtnSubmitJORequestDefIcon").addClass('fa fa-upload');
        }
    });
}

function getJORequestDetailsToEdit(requestId){
    $.ajax({
        type: "get",
        url: "get_jo_request_details",
        data: {
            "jo_id" : requestId,
        },
        dataType: "json",
        success: function (response) {
            if(response['JODetails'].length == 1){
                $('#generated_jo_no').val(response['JODetails'][0]['jo_ctrl_no'])
                $('#add_requestor').val(response['JODetails'][0]['rapidx_user_details']['name'])
                $('#add_department').val(response['JODetails'][0]['department'])
                $('#add_date_prepared').val(response['JODetails'][0]['date_filed'])
                $('#add_equipment_name').val(response['JODetails'][0]['equipment_name'])
                $('#add_equipment_number').val(response['JODetails'][0]['equipment_no'])
                $('#add_jo_description').val(response['JODetails'][0]['job_description'])
                $('#add_initial_action').val(response['JODetails'][0]['initial_action'])
                $('#add_allocated_budget').val(response['JODetails'][0]['allocated_budget'])
                $('#add_requestor_id').val(response['JODetails'][0]['user_id'])
                $('#txtEditReuploadedfile').val(response['JODetails'][0]['orig_name'])

                $('#add_factory').val(response['JODetails'][0]['factory_classification']).trigger('change');

                setTimeout(() => {
                    $('#add_jo_request_checker').val(response['JODetails'][0]['checked_by_id']).trigger('change');
                    $('#add_jo_request_approver').val(response['JODetails'][0]['section_head_id']).trigger('change');
                }, 1000);
                
                if(response['JODetails'][0]['orig_name'] != null){
                    console.log('true');
                    $('#add_jo_request_type', $('#formAddJORequest')).val(2).trigger('change');
                    $("#txtEditReuploadedfile").removeClass('d-none');
                    $(".show_checkbox").removeClass('d-none');
                    $(".show_attachment").removeClass('d-none');
                }else{
                    $('#add_jo_request_type', $('#formAddJORequest')).val(1).trigger('change');
                    $(".show_checkbox").addClass('d-none');
                }

                $('#check_box').on('click', function() {
                    $('#check_box').attr('checked', 'checked');
                    if($(this).is(":checked")){
                        $(".show_attachment").addClass('d-none');
                        $("#txtEditReuploadedfile").removeClass('d-none');
                        $(".show_upload_attachment").removeClass('d-none');
                    }
                    else{
                        $(".show_attachment").removeClass('d-none');
                        $("#txtEditReuploadedfile").removeClass('d-none');
                        $(".show_upload_attachment").addClass('d-none');
                    }
                    
                });
                if(response['JODetails'][0]['currency'] == 1){
                    $('#add_budget_type', $('#formAddJORequest')).val(1).trigger('change');
                }else{
                    $('#add_budget_type', $('#formAddJORequest')).val(2).trigger('change');
                }
            }
        }
    });
}

function getJORequestDetailsToCheck(requestId){
    $.ajax({
        type: "get",
        url: "get_jo_request_details",
        data: {
            "jo_id" : requestId,
        },
        dataType: "json",
        success: function (response) {
            if(response['JODetails'].length == 1){
                
                $('#txtJO_No').val(response['JODetails'][0]['jo_ctrl_no'])
                $('#txtRequestor').val(response['JODetails'][0]['rapidx_user_details']['name'])
                $('#txtDepartment').val(response['JODetails'][0]['department'])
                $('#txtDatePrepared').val(response['JODetails'][0]['date_filed'])
                $('#txtEquipmentName').val(response['JODetails'][0]['equipment_name'])
                $('#txtEquipmentNumber').val(response['JODetails'][0]['equipment_no'])
                $('#txtJoDescription').val(response['JODetails'][0]['job_description'])
                $('#txtInitialAction').val(response['JODetails'][0]['initial_action'])
                $('#txtAllocatedBudget').val(response['JODetails'][0]['allocated_budget'])
                $('#txtCheckedy').val(response['JODetails'][0]['user_access_details']['rapidx_user_details']['name'])
                $('#txtJoRequestApprover').val(response['JODetails'][0]['rapidx_section_head_details']['name'])
                // $('#add_requestor_id').val(response['JODetails'][0]['user_id'])
                if(response['JODetails'][0]['currency'] == 1){
                    $('#txtBudgetType').val('$');
                }else{
                    $('#txtBudgetType').val('PHP');
                }
                $('#txtFactoryClassification').val(response['JODetails'][0]['factory_classification']);

                if(response['JODetails'][0]['orig_name'] == null){
                    console.log('walang laman');
                    $('#txtAttachmentFileName').val('-----')
                }else{
                    $('#txtAttachmentFileName').val(response['JODetails'][0]['orig_name'])

                }
            }

        }
    });
}

// Approve Request
function CheckedJoRequest(){
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

    let form_data = new FormData($('#formCheckedJORequest')[0]);

    $.ajax({
        url: "check_jo_request",
        method: "post",
        processData: false,
        contentType: false,
        data: form_data,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnDisapproveCheckedRequest").addClass('fa fa-spinner fa-pulse');
            $("#iBtnCheckedRequest").addClass('fa fa-spinner fa-pulse');
            $("#btnDisapproveCheckedRequest").prop('disabled', 'disabled');
            $("#btnCheckedRequest").prop('disabled', 'disabled');
        },              
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#modalCheckedRequest").modal('hide');
              $("#formCheckedJORequest")[0].reset();
              
              $("#iBtnDisapproveCheckedRequest").removeClass('fa fa-spinner fa-pulse');
              $("#iBtnCheckedRequest").removeClass('fa fa-spinner fa-pulse');
              $("#btnDisapproveCheckedRequest").removeAttr('disabled');
              $("#btnCheckedRequest").removeAttr('disabled');

              dt_jo_requests.draw();
              toastr.success('Request succesfully Checked!');       
            }
            else if(JsonObject['result'] == 'error'){
              $("#modalCheckedRequest").modal('hide');
              $("#formCheckedJORequest")[0].reset();
              
                // toastr.error('Request Approval Failed! Date approved > Date Needed');
                $("#iBtnDisapproveCheckedRequest").removeClass('fa fa-spinner fa-pulse');
                $("#iBtnCheckedRequest").removeClass('fa fa-spinner fa-pulse');
                $("#btnDisapproveCheckedRequest").removeAttr('disabled');
                $("#btnCheckedRequest").removeAttr('disabled');                                                        
            }else{
              toastr.error('Request Approval Failed!');
              $("#iBtnDisapproveCheckedRequest").removeClass('fa fa-spinner fa-pulse');
              $("#iBtnCheckedRequest").removeClass('fa fa-spinner fa-pulse');
              $("#btnDisapproveCheckedRequest").removeAttr('disabled');
              $("#btnCheckedRequest").removeAttr('disabled');   
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
        }
    });
}

// Approve Request
function ApprovedJoRequest(){
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

    let form_data = new FormData($('#formApprovedJORequest')[0]);

    $.ajax({
        url: "approve_jo_request",
        method: "post",
        processData: false,
        contentType: false,
        data: form_data,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnDisapproveRequest").addClass('fa fa-spinner fa-pulse');
            $("#btnDisapprovedRequest").prop('disabled', 'disabled');
            $("#iBtnApprovedRequest").addClass('fa fa-spinner fa-pulse');
            $("#btnApprovedRequest").prop('disabled', 'disabled');
        },              
        success: function(JsonObject){
            if(JsonObject['result'] == 1){
              $("#modalApprovedRequest").modal('hide');
              $("#formApprovedJORequest")[0].reset();
              
              $("#iBtnDisapproveRequest").removeClass('fa fa-spinner fa-pulse');
              $("#btnDisapprovedRequest").removeAttr('disabled');
              $("#iBtnApprovedRequest").removeClass('fa fa-spinner fa-pulse');
              $("#btnApprovedRequest").removeAttr('disabled');

              dt_jo_requests.draw();
              toastr.success('Request succesfully Approved!');       
            }
            else if(JsonObject['result'] == 'error'){
              $("#modalApprovedRequest").modal('hide');
              $("#formApprovedJORequest")[0].reset();
              
                // toastr.error('Request Approval Failed! Date approved > Date Needed');
                $("#iBtnDisapproveRequest").removeClass('fa fa-spinner fa-pulse');
                $("#btnDisapprovedRequest").removeAttr('disabled');
                $("#iBtnApprovedRequest").removeClass('fa fa-spinner fa-pulse');
                $("#btnApprovedRequest").removeAttr('disabled');                                                        
            }else{
              toastr.error('Request Approval Failed!');
              $("#iBtnDisapproveRequest").removeClass('fa fa-spinner fa-pulse');
              $("#btnDisapprovedRequest").removeAttr('disabled');
              $("#iBtnApprovedRequest").removeClass('fa fa-spinner fa-pulse');
              $("#btnApprovedRequest").removeAttr('disabled');   
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
        }
    });
}



function getJORequestDetailsToApprove(requestId){
    $.ajax({
        type: "get",
        url: "get_jo_request_details",
        data: {
            "jo_id" : requestId,
        },
        dataType: "json",
        success: function (response) {
            if(response['JODetails'].length == 1){
                
                $('#txtApprovedJO_No').val(response['JODetails'][0]['jo_ctrl_no'])
                $('#txtApprovedRequestor').val(response['JODetails'][0]['rapidx_user_details']['name'])
                $('#txtApprovedDepartment').val(response['JODetails'][0]['department'])
                $('#txtApprovedDatePrepared').val(response['JODetails'][0]['date_filed'])
                $('#txtApprovedEquipmentName').val(response['JODetails'][0]['equipment_name'])
                $('#txtApprovedEquipmentNumber').val(response['JODetails'][0]['equipment_no'])
                $('#txtApprovedJoDescription').val(response['JODetails'][0]['job_description'])
                $('#txtApprovedInitialAction').val(response['JODetails'][0]['initial_action'])
                $('#txtApprovedAllocatedBudget').val(response['JODetails'][0]['allocated_budget'])
                $('#txtApprovedCheckedy').val(response['JODetails'][0]['user_access_details']['rapidx_user_details']['name'])
                $('#txtApprovedJoRequestApprover').val(response['JODetails'][0]['rapidx_section_head_details']['name'])
                // $('#add_requestor_id').val(response['JODetails'][0]['user_id'])
                if(response['JODetails'][0]['currency'] == 1){
                    $('#txtApprovedBudgetType').val('$');
                }else{
                    $('#txtApprovedBudgetType').val('PHP');
                }
                $('#txtApprovedFactoryClassification').val(response['JODetails'][0]['factory_classification']);

                if(response['JODetails'][0]['orig_name'] == null){
                    // console.log('walang laman');
                    $('#txtApprovedAttachmentFileName').val('-----')
                }else{
                    $('#txtApprovedAttachmentFileName').val(response['JODetails'][0]['orig_name'])

                }
            }

        }
    });
}

function getDataOfCompletedJORequest(requestId){
    $.ajax({
        type: "get",
        url: "get_completed_jo_request_details",
        data: {
            "jo_id" : requestId,
        },
        dataType: "json",
        success: function (response) {
            if(response['completedJoRequestDetails'].length == 1){

                $('#txtCompetedJoNo').val(response['completedJoRequestDetails'][0]['jo_ctrl_no'])
                $('#txtCompleteEquipName').val(response['completedJoRequestDetails'][0]['equipment_name'])
                $('#txtCCompleteRequestor').val(response['completedJoRequestDetails'][0]['rapidx_user_details']['name'])
                $('#txtCCompleteDepartment').val(response['completedJoRequestDetails'][0]['department'])
                $('#txtCCompleteAllocatedBudget').val(response['completedJoRequestDetails'][0]['allocated_budget'])

                $('#txtCompleteEquipNumber').val(response['completedJoRequestDetails'][0]['equipment_no'])
                $('#txtCCompleteDatePrepared').val(response['completedJoRequestDetails'][0]['date_filed'])
                $('#txtCCompleteJoDescription').val(response['completedJoRequestDetails'][0]['job_description'])
                $('#txtCCompleteInitialAction').val(response['completedJoRequestDetails'][0]['initial_action'])

                if(response['completedJoRequestDetails'][0]['orig_name'] != null){
                    $('#txtCCompleteAttachmentFileName').val(response['completedJoRequestDetails'][0]['orig_name']);
                }else{
                    $('#txtCCompleteAttachmentFileName').val('---');
                }

                $('#txtCCompleteFactoryClassification').val(response['completedJoRequestDetails'][0]['factory_classification']).trigger('change');
                if(response['completedJoRequestDetails'][0]['currency'] == 1){
                    $('#txtCCompleteBudgetType').val('$');
                }else{
                    $('#txtCCompleteBudgetType').val('PHP');
                }

                setTimeout(() => {
                    $('#txtCCompleteCheckedBy').val(response['completedJoRequestDetails'][0]['user_access_details']['rapidx_user_details']['name']);
                    $('#txtCCompleteApproverName').val(response['completedJoRequestDetails'][0]['rapidx_section_head_details']['name']);
                    $('#txtCompleteFasEngrAssigned').val(response['completedJoRequestDetails'][0]['jo_requests_conformance']['assessed_by']).trigger('change');
                }, 500);

                
                $('#txtCompleteFasClassification').val(response['completedJoRequestDetails'][0]['jo_requests_conformance']['job_classification']).trigger('change');
                $('#txtCompleteFasAssessment').val(response['completedJoRequestDetails'][0]['jo_requests_conformance']['fas_assessment']);
                $('#txtCompleteEstimatedCompletionDate').val(response['completedJoRequestDetails'][0]['jo_requests_conformance']['estimated_completion_date']);
                $('#txtCompleteEstimatedTypeId').val(response['completedJoRequestDetails'][0]['jo_requests_conformance']['estimated_type']);
                $('#txtCompleteEstimatedCost').val(response['completedJoRequestDetails'][0]['jo_requests_conformance']['estimated_cost']);
                $('#txtCompleteFasRemarks').val(response['completedJoRequestDetails'][0]['jo_requests_conformance']['conformance_remarks']);

                if(response['completedJoRequestDetails'][0]['jo_requests_conformance']['recommendation'] == 3){
                    $('input[name="recommendation"][value="3"]').prop('checked', true);
                    $('#txtCompleteOthersRecommendation').val(response['conformanceDetails'][0]['others_recommendation']);
                }else if(response['completedJoRequestDetails'][0]['jo_requests_conformance']['recommendation'] == 2){
                    $('input[name="recommendation"][value="2"]').prop('checked', true);
                }else if(response['completedJoRequestDetails'][0]['jo_requests_conformance']['recommendation'] == 1){
                    $('input[name="recommendation"][value="1"]').prop('checked', true);
                }

                

                if(response['completedJoRequestDetails'][0]['jo_requests_conformance']['initial_disapproval_remarks'] != null){
                    $('#kteCompletedDisconfirmRemarksID').prop('hidden', false);
                    $('#txtCompleteKTEDisconfirmRemarks').val(response['completedJoRequestDetails'][0]['jo_requests_conformance']['initial_disapproval_remarks']);
                }else{
                    $('#kteCompletedDisconfirmRemarksID').prop('hidden', true);
                }

                if(response['completedJoRequestDetails'][0]['jo_requests_conformance']['final_approval_1_disapproval_remarks'] != null){
                    $('#jcpCompletedDisconfirmRemarksID').prop('hidden', false);
                    $('#txtCompleteJCPDisconfirmRemarks').val(response['completedJoRequestDetails'][0]['jo_requests_conformance']['final_approval_1_disapproval_remarks']);
                }else{
                    $('#jcpCompletedDisconfirmRemarksID').prop('hidden', true);
                }
                if(response['completedJoRequestDetails'][0]['jo_requests_conformance']['final_approval_2_disapproval_remarks'] != null){
                    $('#NCPCompletedDisconfirmRemarksID').prop('hidden', false);
                    $('#txtCompleteNCPDisconfirmRemarks').val(response['completedJoRequestDetails'][0]['jo_requests_conformance']['final_approval_2_disapproval_remarks']);
                }else{
                    $('#NCPCompletedDisconfirmRemarksID').prop('hidden', true);

                }
            }
        }
    });
}
// 