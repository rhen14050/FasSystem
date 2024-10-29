const LoadRapidXUserList = (cboElement) => {
    $.ajax({

        url: "load_rapidx_user_list",
        method: "get",
        dataType: "json",
        beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(JsonObject){
            result = '';
            if(JsonObject['users'].length > 0){
                result = '<option selected disabled>-- Select One -- </option>';
                for(let index = 0; index < JsonObject['users'].length; index++){
                    let disabled = '';

                    if(JsonObject['users'][index].status == 2){
                        disabled = 'disabled';
                    }
                    else{
                        disabled = '';
                    }
                    result += '<option data-code="' + JsonObject['users'][index].employee_id + '" value="' + JsonObject['users'][index].id + '" ' + disabled + '>' + JsonObject['users'][index].name + '</option>';
                }
            }
            else{
                result = '<option value=""> -- No record found -- </option>';
            }

            cboElement.html(result);
        },
        error: function(data, xhr, status){
            result = '<option value=""> -- Reload Again -- </option>';
            cboElement.html(result);
            console.log('Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }

    });
}

function LoadRapidXUserListSectionHead(cboElement){
    let result = '<option value="">N/A</option>';

    $.ajax({

    url: "load_rapidx_user_list_sectionhead",
    method: "get",
    dataType: "json",
    beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(JsonObject){
            
            result = '';
            if(JsonObject['users'].length > 0){
                result = '<option selected disabled>-- Select One -- </option>';
                for(let index = 0; index < JsonObject['users'].length; index++){
                    
                    result += '<option value="' + JsonObject['users'][index].rapidx_id + '">' + JsonObject['users'][index].rapidx_user_details.name + '</option>';

                }
            }
            else{
                result = '<option value=""> -- No record found -- </option>';
            }

            cboElement.html(result);
        },
        error: function(data, xhr, status){
            result = '<option value=""> -- Reload Again -- </option>';
            cboElement.html(result);
            console.log('Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }

    });
}

function loadKakampinkDetails(cboElement){
    let result = '<option value="">N/A</option>';

    $.ajax({

    url: "load_kakampink",
    method: "get",
    dataType: "json",
    beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(JsonObject){
            result = '';
            if(JsonObject['kakampink'].length > 0){
                result = '<option selected disabled>-- Select One -- </option>';
                for(let index = 0; index < JsonObject['kakampink'].length; index++){
                    result += '<option value="' + JsonObject['kakampink'][index].rapidx_id + '">' + JsonObject['kakampink'][index].rapidx_user_details.name + '</option>';

                }
            }
            else{
                result = '<option value=""> -- No record found -- </option>';
            }

            cboElement.html(result);
        },
        error: function(data, xhr, status){
            result = '<option value=""> -- Reload Again -- </option>';
            cboElement.html(result);
            console.log('Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }

    });
}

function loadFasEngineers(cboElement){
    let result = '<option value="">N/A</option>';

    $.ajax({

    url: "load_fas_engineers",
    method: "get",
    dataType: "json",
    beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(JsonObject){
            result = '';
            if(JsonObject['fasEngineers'].length > 0){
                result = '<option selected disabled>-- Select One -- </option>';
                for(let index = 0; index < JsonObject['fasEngineers'].length; index++){
                    result += '<option value="' + JsonObject['fasEngineers'][index].rapidx_id + '">' + JsonObject['fasEngineers'][index].rapidx_user_details.name + '</option>';

                }
            }
            else{
                result = '<option value=""> -- No record found -- </option>';
            }

            cboElement.html(result);
        },
        error: function(data, xhr, status){
            result = '<option value=""> -- Reload Again -- </option>';
            cboElement.html(result);
            console.log('Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }

    });
}

function getUserToEdit(userId){
    $.ajax({
        type: "get",
        url: "get_user_details",
        data: {
            "user_id" : userId,
        },
        dataType: "json",
        success: function (response) {
            console.log(response['userDetails'][0]['rapidx_user_details']['name']);
            if(response['userDetails'].length == 1){
                setTimeout(() => {
                    $('#rapidXUserId').val(response['userDetails'][0]['rapidx_id']).trigger('change');
                    $('#accessLevelId').val(response['userDetails'][0]['access_level']).trigger('change');
                    $('#userSectionId').val(response['userDetails'][0]['section']).trigger('change');
                }, 500);
            }
        }
    });
}
