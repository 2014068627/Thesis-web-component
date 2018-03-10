<?php require_once(__DIR__."/../php_include/check_session.php"); ?>
<?php require_once(__DIR__."/../php_include/db_connect.php");?>
<?php
    $query = "SELECT DISTINCT ID, NAME, USERNAME FROM user_table WHERE id!=1";
    $user_result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $user_count = mysqli_num_rows($user_result);
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="../includes/css/main.css">
  <script src="../includes/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
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
            $('#editUserName').val(jsondata.username);
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
    });

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
    
    

    
  </script>
</head>
<body>
  <div id="header"><form action="logout.php" method="POST"><input type="hidden" name="logout" value="logout"/><input type="submit" value="LOGOUT"/></form></div>
  <div class="container">
    <img id="logo" src="../includes/src/logo.png"/>


    <div>
        <p>User Count: <span id="user_count"><?php echo $user_count; ?></span>/5</p>
    </div>
    <!--DIV contains user name, edit button, and delete button-->
    <div id="WholeUserContainer" >
        <?php
            while($row = $user_result->fetch_assoc()){
                
                echo '<div class="UserContainer"><div class="UserName"><br><input id="user-'. $row['ID'] .'" class="userNameVal" name="username" value="'. $row['NAME'] .'"></div>'.
                '<button id="update-'. $row['ID'] .'" class="edit" onclick="javascript:showEdit(this);"><img src="../includes/src/edit.png"></button>'.
                '<button id="delete-'. $row['ID'] .'" class="deleteBttn" type="submit"><img src="../includes/src/delete.png"></button>'.
                '</div>';
            }
        ?>
    </div>

    <!--ADD USER-->
    <?php 
        if($user_count >= 5){
        }else{
            echo '<button id="addUserBttn" onclick="javascript:showAdd();">ADD USER</button>';
        }
    ?>
    

  </div>
  <div id="popBG"><!--Gray background-->
    <div id="formCon"><!--Container for forms-->
      <!--FORM for add users-->
      <form action="crud_user.php" method="POST" id="addUser">
        <div>ADD USER</div>
        NAME:
        <input class="input" type="text" name="name" required>
        USERNAME:
        <input class="input" type="text" name="username" required>
        PASSWORD:
        <input class="input" type="password" name="password" required>
        CONFIRM PASSWORD:
        <input class="input" type="password" name="cpassword" required>
        <div class="SCCon">
          <input id="submitBttn" type="submit" value="CREATE">
          <input id="cancelBttn" type="button" value="CANCEL" onclick="javascript:Cancel();">
        </div>
      </form>
      <!--FORM for editing-->
      <form action="crud_user_update.php" method="POST" id="EditUser">
        <input type="hidden" id="editId" name="id" required>
        <div>EDIT USER</div>
        NAME:
        <input class="input" id="editName" type="text" name="name" required>
        USERNAME:
        <input class="input" id="editUserName" type="text" name="username" required>
        PASSWORD:
        <input class="input" id="editPass" type="password" name="password" required>
        <div class="SCCon">
          <input id="submitBttn" type="submit" value="UPDATE">
          <input id="cancelBttn" type="button" value="CANCEL" onclick="javascript:Cancel();">
        </div>
      </form>
    </div>
  </div>

</body>
</html>
