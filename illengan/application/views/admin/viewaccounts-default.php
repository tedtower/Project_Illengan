$(function() {
    viewAccountsJs();
    //get data for delete record
    $('#show_data').on('click', '.item_delete', function() {
        var account_id = $(this).data('account_id');
        console.log('account_id ' + account_id);
        $('#Modal_Remove').modal('show');
        $('[name="account_id_remove"]').val(account_id);
    });

    //delete record to database
    $('#btn_cancel').on('click', function () {
        var account_id = $('#account_id_remove').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/accounts/delete')?>",
            dataType: "JSON",
            data: {
                account_id: account_id
            },
            success: function (data) {
                $('[name="account_id_remove"]').val("");
                alert("Record removed successfully!");
                $('#Modal_Remove').modal('hide');
                table.DataTable().ajax.reload(null, false);
            }
        });
        return false;
    });
    //EDIT MODAL
    $("#formEdit").on('submit', function (event) {
        event.preventDefault();
        var tableCode = $(this).find("input[name='prevTableCode']").val();
        var newTableCode = $(this).find("input[name='tableCode']").val();
        $.ajax({
            url: '<?= site_url('admin/accounts/edit')?>',
            method: 'post',
            data: {
                prevTableCode: tableCode,
                tableCode: newTableCode
            },
            dataType: 'json',
            success: function (data) {
                accounts = data;
                setAccountData();
            },
            error: function (response, setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
        });
    });
    // });



    // var tuples = ((document.getElementById('accountsTable')).getElementsByTagName('tbody'))[0]
    //     .getElementsByTagName(
    //         'tr');
    // var tupleNo = tuples.length;
    // var editButtons = document.getElementsByName('editAccounts');
    // var editModal = document.getElementById('editAccounts');
    // for (var x = 0; x < tupleNo; x++) {
    //     editButtons[x].addEventListener("click", showEditModal);
    // }

    // function showEditModal(event) {
    //     var row = event.target.parentElement.parentElement.parentElement;
    //     document.getElementById('account_id').value = parseInt(row.firstElementChild.innerHTML);
    //     document.getElementById('account_username').value = (row.firstElementChild.nextElementSibling
    //         .innerHTML).trim();
    //     document.getElementById('account_type').value = capitalizeFirstLetter((row.firstElementChild
    //         .nextElementSibling
    //         .nextElementSibling.innerHTML).trim());

    // }

    //function for editing Account Password
    $('#show_data').on('click', '.item_edit', function () {
        var account_id = $(this).data('account_id');
        //document.getElementById("User_Id").value.

        $('#editPasswordModal').modal('show');
        $('[name="account_id"]').val(account_id);
    });

    //update record to database
    $('#btn_update').on('click', function () {
        var account_id = $('#account_id').val();
        var old_password = $('#old_password').val();
        var new_password = $('#new_password').val();
        var new_password_confirmation = $('#new_password_confirmation').val();
        $.ajax({
            type: "POST",
            url: "http://illengan.com/admin/accounts/changepassword",
            dataType: "JSON",
            data: {
                account_id: account_id,
                old_password: old_password,
                new_password: new_password,
                new_password_confirmation: new_password_confirmation
            },
            success: function (data) {
                $('[name="account_id"]').val("");
                $('[name="old_password"]').val("");
                $('[name="new_password"]').val("");
                $('[name="new_password_confirmation"]').val("");
                $('#editPasswordModal').modal('hide');
                alert("Table Code was successfully updated!");
                location.reload();
            }
        });
        return false;
    });

    // function for editing Table code
    //     function submitform(){
    // 	var User_Id=document.getElementById("account_id").value
    // 	var User_pass1=document.getElementById("old_password").value
    //     var User_pass2=document.getElementById("new_password").value
    //     var confirm_password =document.getElementById("new_password_confirmation").value
    // 	document.getElementById("old_password").value="";
    //     document.getElementById("new_password").value="";
    //     document.getElementById("new_password_confirmation").value="";

    // 		$.ajax({
    //    		type: "POST",
    //    		url: "http://illengan.com/admin/accounts/changepassword",
    //         dataType:"JSON"
    //         data:{account_id:account_id , 
    //             old_password:old_password, 
    //             new_password:new_password, 
    //             new_password_confirmation:new_password_confirmation}
    //    		success: function(data){
    //                $('[name="account_id')
    //      	alert( "Password Succcessfully Updated" );
    // 		document.getElementById("err").innerHTML=msg;		
    //    		}
    //  		});
    //         return;


    //         $.ajax({
    //                 type : "POST",
    //                 url  : "http://illengan.com/barista/editTableNumber",
    //                 dataType : "JSON",
    //                 data : {account_id:account_id , table_code:table_code},
    //                 success: function(data){
    //                     $('[name="account_id_edit"]').val("");
    //                     $('[name="table_code_edit"]').val("");
    //                     $('#editPasswordModal').modal('hide');
    //                     alert("Table Code was successfully updated!");
    //                     location.reload();
    //                     //view_product();
    //                 }
    //             });

    //  }

}



<button class="deleteBtn btn btn-danger btn-sm" data-toggle="modal" 
                            data-target="#deleteAccount">Delete</button>



                            $("#confirmDelete").on('submit', function(event){
        event.preventDefault();
        var accountId = $(this).find("input").val();
        $.ajax({
            url: '<?= site_url('admin/accounts/delete')?>',
            method: 'POST',
            data: {accountId : accountId},
            dataType: 'json',
            success: function(data){
                accounts = data;
                setAccountData();
            },
            error: function(response, setting, errorThrown){
                console.log(response.responseText);
                console.log(errorThrown);
            }
        });
    });