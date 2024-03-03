<?php 
    include_once 'header.php'
?>

<h1 id="index-text">Xin chào ! <?php if(isset($_SESSION['userId'])){
        echo explode(" ", $_SESSION['userName'])[0];
    }else{
        echo 'Khách hàng mới';
    } 
    ?> </h1>


<?php 
    include_once 'footer.php'
?>