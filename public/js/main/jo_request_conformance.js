function getJORequestDetailsToConform(requestId){
    $.ajax({
        type: "get",
        url: "get_jo_request_details",
        data: {
            "jo_id" : requestId,
        },
        dataType: "json",
        success: function (response) {
            // console.log(response['JODetails']);
            if(response['JODetails'].length == 1){
                $('#txtJoNo').val(response['JODetails'][0]['jo_ctrl_no'])
                $('#txtCRequestor').val(response['JODetails'][0]['rapidx_user_details']['name'])
                $('#txtCDepartment').val(response['JODetails'][0]['department'])
                $('#txtCDatePrepared').val(response['JODetails'][0]['date_filed'])
                $('#txtEquipName').val(response['JODetails'][0]['equipment_name'])
                $('#txtEquipNumber').val(response['JODetails'][0]['equipment_no'])
                $('#txtCJoDescription').val(response['JODetails'][0]['job_description'])
                $('#txtCInitialAction').val(response['JODetails'][0]['initial_action'])
                $('#txtCAllocatedBudget').val(response['JODetails'][0]['allocated_budget'])

                $('#txtCFactoryClassification').val(response['JODetails'][0]['factory_classification']).trigger('change');

                setTimeout(() => {
                    $('#txtCCheckedBy').val(response['JODetails'][0]['user_access_details']['rapidx_user_details']['name']);
                    $('#txtCApproverName').val(response['JODetails'][0]['rapidx_section_head_details']['name']);
                }, 500);
                
                if(response['JODetails'][0]['orig_name'] != null){
                    $('#txtCAttachmentFileName').val(response['JODetails'][0]['orig_name'])
                }else{
                  $("#txtCAttachmentFileName").val('---');
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
                    $('#txtCBudgetType').val('$');
                }else{
                    $('#txtCBudgetType').val('PHP');
                }
            }
        }
    });
}

function AddConformanceDetails(){
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

    let form_data = new FormData($('#formConformRequest')[0]);

    $.ajax({
    url: "add_conformance_details",
    method: "post",
    processData: false,
    contentType: false,
    data: form_data,
    dataType: "json",
    beforeSend: function(){
        $("#ibtnConformJoDetailsIcon").removeClass('fa fa-upload')
        $("#ibtnConformJoDetailsIcon").addClass('fa fa-spinner fa-pulse');
        $("#btnConformJoDetails").prop('disabled', 'disabled');
    },
    success: function(JsonObject){

        $("#ibtnConformJoDetailsIcon").removeClass('fa fa-spinner fa-pulse');
        $("#btnConformJoDetails").removeAttr('disabled');
        $("#ibtnConformJoDetailsIcon").addClass('fa fa-upload');

        if(JsonObject['result'] == 1){
        $("#modalConformRequest").modal('hide');
        $("#formConformRequest")[0].reset();        

        // console.log('success');
        dt_jo_requests.draw();
        toastr.success('Request succesfully saved!');       
        }
        else{
            toastr.error(' Saving Request Failed!');

            if(JsonObject['error']['fas_engr_assigned'] === undefined){
                $("#txtFasEngrAssigned").removeClass('is-invalid');
                $("#txtFasEngrAssigned").attr('title', '');
            }
            else{
                $("#txtFasEngrAssigned").addClass('is-invalid');
                $("#txtFasEngrAssigned").attr('title', JsonObject['error']['fas_engr_assigned']);
            }

            if(JsonObject['error']['conformace_classification'] === undefined){
                $("#txtFasClassification").removeClass('is-invalid');
                $("#txtFasClassification").attr('title', '');
            }
            else{
                $("#txtFasClassification").addClass('is-invalid');
                $("#txtFasClassification").attr('title', JsonObject['error']['conformace_classification']);
            }
            
            if(JsonObject['error']['completion_date'] === undefined){
                $("#txtEstimatedCompletionDate").removeClass('is-invalid');
                $("#txtEstimatedCompletionDate").attr('title', '');
            }
            else{
                $("#txtEstimatedCompletionDate").addClass('is-invalid');
                $("#txtEstimatedCompletionDate").attr('title', JsonObject['error']['completion_date']);
            }

            if(JsonObject['error']['estimated_cost'] === undefined){
                $("#txtEstimatedCost").removeClass('is-invalid');
                $("#txtEstimatedCost").attr('title', '');
            }
            else{
                $("#txtEstimatedCost").addClass('is-invalid');
                $("#txtEstimatedCost").attr('title', JsonObject['error']['estimated_cost']);
            }

            if(JsonObject['error']['estimated_cost'] === undefined){
                $("#txtFasRemarks").removeClass('is-invalid');
                $("#txtFasRemarks").attr('title', '');
            }
            else{
                $("#txtFasRemarks").addClass('is-invalid');
                $("#txtFasRemarks").attr('title', JsonObject['error']['estimated_cost']);
            }

        
        }

    },
    error: function(data, xhr, status){
        toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
        $("#ibtnConformJoDetailsIcon").removeClass('fa fa-spinner fa-pulse');
        $("#btnConformJoDetails").removeAttr('disabled');
        $("#ibtnConformJoDetailsIcon").addClass('fa fa-upload');
    }
});
}

function getJoRequestConformanceDetails(requestId) {
    $.ajax({
        type: "get",
        url: "get_conformance_details",
        data: {
            "conformance_id" : requestId,
        },
        dataType: "json",
        success: function (response) {
            if(response['conformanceDetails'].length == 1){
                $('#txtconformanceStatus').val(response['conformanceDetails'][0]['conformance_status'])
                $('#conformRequestId').val(response['conformanceDetails'][0]['id'])
                
                if(response['conformanceDetails'][0]['initial_disapproval_remarks'] != null){
                    $('#kteDisconfirmRemarksID').prop('hidden', false);
                    $('#txtKTEDisconfirmRemarks').val(response['conformanceDetails'][0]['initial_disapproval_remarks'])
                }else{
                    $('#kteDisconfirmRemarksID').prop('hidden', true);

                }

                if(response['conformanceDetails'][0]['final_approval_1_disapproval_remarks'] != null){
                    $('#jcpDisconfirmRemarksID').prop('hidden', false);
                    $('#txtJCPDisconfirmRemarks').val(response['conformanceDetails'][0]['final_approval_1_disapproval_remarks'])
                }else{
                    $('#jcpDisconfirmRemarksID').prop('hidden', true);

                }

                // console.log(response['conformanceDetails'][0]['final_approval_2_disapproval_remarks']);
                if(response['conformanceDetails'][0]['final_approval_2_disapproval_remarks'] != null){
                    // console.log('false');
                    $('#NCPDisconfirmRemarksID').prop('hidden', false);
                    $('#txtNCPDisconfirmRemarks').val(response['conformanceDetails'][0]['final_approval_2_disapproval_remarks'])
                }else{
                    $('#NCPDisconfirmRemarksID').prop('hidden', true);

                }

                $('#txtFasAssessment').val(response['conformanceDetails'][0]['fas_assessment'])
                $('#txtEstimatedCompletionDate').val(response['conformanceDetails'][0]['estimated_completion_date'])
                $('#txtEstimatedCost').val(response['conformanceDetails'][0]['estimated_cost'])
                $('#txtFasRemarks').val(response['conformanceDetails'][0]['conformance_remarks'])
                $('#estimatedTypeId').val(response['conformanceDetails'][0]['estimated_type']).trigger('change');
                $('#txtFasClassification').val(response['conformanceDetails'][0]['job_classification']).trigger('change');

                if(response['conformanceDetails'][0]['assessed_by'] != null){
                    $('#txtFasClassification').removeAttr('disabled');
                    $('#txtRecommendation1').removeAttr('disabled');
                    $('#txtRecommendation2').removeAttr('disabled');
                    $('#txtRecommendation3').removeAttr('disabled');
                    $('#estimatedTypeId').removeAttr('disabled');
                    $('#txtEstimatedCompletionDate').removeAttr('readonly');
                    $('#txtEstimatedCost').removeAttr('readonly');
                    $('#txtFasRemarks').removeAttr('readonly');
                    $('#txtFasAssessment').removeAttr('readonly');
                }

                setTimeout(() => {
                    $('#txtFasEngrAssigned').val(response['conformanceDetails'][0]['assessed_by']).trigger('change');
                }, 500);

                if(response['conformanceDetails'][0]['recommendation'] == 3){
                    $('input[name="recommendation"][value="3"]').prop('checked', true);
                    $('#txtOthersRecommendation').val(response['conformanceDetails'][0]['others_recommendation']);
                }else if(response['conformanceDetails'][0]['recommendation'] == 2){
                    $('input[name="recommendation"][value="2"]').prop('checked', true);
                }else if(response['conformanceDetails'][0]['recommendation'] == 1){
                    $('input[name="recommendation"][value="1"]').prop('checked', true);
                }

            }else{
                $('#txtconformanceStatus').val('');
                $('#conformRequestId').val('');
                $('#txtFasEngrAssigned').removeAttr('readonly');
                $('#txtFasClassification').prop('disabled', true);
                $('#txtRecommendation1').prop('disabled', true);
                $('#txtRecommendation2').prop('disabled', true);
                $('#txtRecommendation3').prop('disabled', true);
                $('#estimatedTypeId').prop('disabled', true);
                $('#txtEstimatedCompletionDate').prop('readonly', true);
                $('#txtEstimatedCost').prop('readonly', true);
                $('#txtFasRemarks').prop('readonly', true);
                $('#txtFasAssessment').prop('readonly', true);

                $('#txtFasAssessment').val('');
                $('#txtEstimatedCompletionDate').val('');
                $('#txtEstimatedCost').val('');
                $('#estimatedTypeId').val('');
                $('#txtFasRemarks').val('');
                $('#txtFasClassification').val('');
                $('#txtOthersRecommendation').val('');
                $('input[type="radio"][name="recommendation"]').prop('checked', false);
            }
        }
    });
}

// function AssignedEngr(){
//     toastr.options = {
//         "closeButton": false,
//         "debug": false,
//         "newestOnTop": true,
//         "progressBar": true,
//         "positionClass": "toast-top-right",
//         "preventDuplicates": false,
//         "onclick": null,
//         "showDuration": "300",
//         "hideDuration": "3000",
//         "timeOut": "3000",
//         "extendedTimeOut": "3000",
//         "showEasing": "swing",
//         "hideEasing": "linear",
//         "showMethod": "fadeIn",
//         "hideMethod": "fadeOut",
//         };
    
//         let form_data = new FormData($('#formConformRequest')[0]);
    
//         $.ajax({
//         url: "add_engineer",
//         method: "post",
//         processData: false,
//         contentType: false,
//         data: form_data,
//         dataType: "json",
//         beforeSend: function(){
//             $("#ibtnConformJoDetailsIcon").removeClass('fa fa-upload')
//             $("#ibtnConformJoDetailsIcon").addClass('fa fa-spinner fa-pulse');
//             $("#btnConformJoDetails").prop('disabled', 'disabled');
//         },
//         success: function(JsonObject){
    
//             $("#ibtnConformJoDetailsIcon").removeClass('fa fa-spinner fa-pulse');
//             $("#btnConformJoDetails").removeAttr('disabled');
//             $("#ibtnConformJoDetailsIcon").addClass('fa fa-upload');
    
//             if(JsonObject['result'] == 1){
//             $("#modalConformRequest").modal('hide');
//             $("#formConformRequest")[0].reset();        
    
//             // console.log('success');
//             dt_jo_requests.draw();
//             toastr.success('Engineer succesfully saved!');       
//             }
//             else{
//                 toastr.error(' Saving Request Failed!');
    
//                 if(JsonObject['error']['fas_engr_assigned'] === undefined){
//                     $("#txtFasEngrAssigned").removeClass('is-invalid');
//                     $("#txtFasEngrAssigned").attr('title', '');
//                 }
//                 else{
//                     $("#txtFasEngrAssigned").addClass('is-invalid');
//                     $("#txtFasEngrAssigned").attr('title', JsonObject['error']['fas_engr_assigned']);
//                 }
    
//             }
    
//         },
//         error: function(data, xhr, status){
//             toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);      
//             $("#ibtnConformJoDetailsIcon").removeClass('fa fa-spinner fa-pulse');
//             $("#btnConformJoDetails").removeAttr('disabled');
//             $("#ibtnConformJoDetailsIcon").addClass('fa fa-upload');
//         }
//     });
// }