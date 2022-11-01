<?php
include( 'connect.php');
if(isset($_POST['id']))
{
$topic = mysqli_real_escape_string($conn, $_POST['id']);
$sql = "SELECT * FROM `vhdl_codes_forum` WHERE `topic` = '$topic'";
if(!$sql){
    echo 'sql error: '. mysqli_connect_error();
}
$result = mysqli_query($conn, $sql);
if(!$result){
    echo 'result error: '. mysqli_connect_error();
}  
$code = mysqli_fetch_assoc($result);
mysqli_free_result($result);
mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<!--Header and navbar-->
<?php include('header.php'); ?>
<div class="container-fluid">
<div class="mx-auto" style="background-color:#fcf5b1;">
<br>
<?php if($code): ?>
<h1 class="display-1 text-center"><u>Topic <?php echo $code['topic'];?></u></h1>
<h4>Question: <?php echo $code['question'];?></h4>
<h4>Answer: </h4><?php echo $code['code'];?>
</div>
</div>
<?php else: ?>
<h5>No such Code exists.</h5>
<?php endif ?>
<!--Footer-->
<?php include('footer.php'); ?>
</html>