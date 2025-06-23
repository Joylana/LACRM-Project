<?php
    include('include/init.php');
    

    echo "<p style='font-size:300px;'>BOOM</p>";
    if(isset($_REQUEST['movementName'])){
        echo "YES!";
    }
    ?>
    <form action="test.php" method="post" id="formId">
        <h2>New Movement:</h2>
        <input type="text" name="movementName">
        <input type="submit"  >
    </form>
    <script>
    var form=document.getElementById("formId");
    function submitForm(event){

    //Preventing page refresh
    event.preventDefault();
    }
    </script>