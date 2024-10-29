const errorHandler = function (errors,formInput){
    if(errors === undefined){
        formInput.removeClass('is-invalid')
        formInput.addClass('is-valid')
        formInput.attr('title', '')
    }else {
        formInput.removeClass('is-valid')
        formInput.addClass('is-invalid');
        formInput.attr('title', errors[0])
    }
}

$('.select2bs5').each(function () {
    $(this).select2({
        theme: 'bootstrap-5',
        dropdownParent: $(this).parent(),
    });
});


const getDataById = (id, tableName, callback) => {

    $.ajax({
        type: "get",
        url: "get_data_by_id",
        data: {
            "id" : id,
            "table" : tableName
        },
        dataType: "json",
        success: function (response) {
            callback(response)
        },
        error: function (data, xhr, status) {
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
    
}

const changeStatus = (id, status,tableName,token, callback) => {
    $.ajax({
        type: "post",
        url: "change_status",
        data: {
            "_token" : token,
            "id" : id,
            "status" : status,
            "table" : tableName
        },
        dataType: "json",
        success: function (response) {
            callback(response);
        },
        error: function (data, xhr, status) {
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}