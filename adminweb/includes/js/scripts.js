$(document).ready( function() {
    $(".edit").click(function showEdit(){
        var user_id = $(this).attr('id').replace('update-', '');

        $.get('crud_user.php', {id : user_id}, function(data){
            var jsondata = JSON.parse(data);
            con = document.getElementById('popBG');
            form1 = document.getElementById('addUser');
            form2 = document.getElementById('EditUser');
            form1.style.display = "none";
            form2.style.display = "block";
            con.style.display = "block";
            $('#editName').val(jsondata.name);
            $('#editUsername').val(jsondata.username);
            $('#editPass').val(jsondata.password);
            $('#editId').val(jsondata.id);
            //alert(jsondata.name);
        });

    });
    $('.deleteBttn').click(function(){
        var user_id = $(this).attr('id').replace('delete-','');
        $.get('crud_user_update.php', {id : user_id}, function(data){
            //var jsondata = JSON.parse(data);
            console.log(data);
            window.location = "";
            });
    });
    $('#addUsername').keyup(function(e){
        clearTimeout($.data(this, 'timer'));
        if(e.keyCode == 13){

        }else{
            $(this).data('timer', setTimeout(validateAddUser, 500));
        }
    });
    $('#editUsername').keyup(function(e){
        clearTimeout($.data(this, 'timer'));
        if(e.keyCode == 13){

        }else{
            $(this).data('timer', setTimeout(validateEditUser, 500));
        }
    });

});

function validateEditUser(force){
    var val = $('#editUsername').val();
    var id = $('#editId').val();
    if(!force && val.length < 1) return;
    var url = 'crud_user_validation.php?username='+val+'&id='+id;
    $.post(url, {username : val, id : id} ,function(data){
        var jsondata = JSON.parse(data);
        if(jsondata.validate == "true"){
            //if username is unique
            alert('User is uniqe: ' + jsondata.validate);
        }else{ 
            //if username is taken
            alert('User is taken: '+jsondata.validate);
        }

    });
}

function validateAddUser(force){
    var val = $('#addUsername').val();
    if(!force && val.length < 1 ) return;
    var url = 'crud_user_validation.php?username='+val;
    
    $.get(url, function(data){
        var jsondata = JSON.parse(data);
        if(jsondata.validate == "true"){
            //if username is unique
            //alert('User is unique '+jsondata.validate);
        }else{
            //if username is taken
            //alert('User is taken ' + jsondata.validate);
        }
    });
}

function showAdd() {
    con = document.getElementById('popBG');
    form1 = document.getElementById('addUser');
    form2 = document.getElementById('EditUser');
    form1.style.display = "block";
    form2.style.display = "none";
    con.style.display = "block";
}

function Cancel(){
    con = document.getElementById('popBG');
    form1 = document.getElementById('addUser');
    form2 = document.getElementById('EditUser');
    form1.style.display = "none";
    form2.style.display = "none";
    con.style.display = "none";

}