<?php
include( 'connect.php');
$sql = "SELECT * FROM `vhdl_codes_forum`";
	if(!$sql){
		echo 'sql error: '. mysqli_connect_error();
	}
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo 'result error: '. mysqli_connect_error();
	}  
$codes =mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<!--Header and navbar-->
<?php include('header.php'); ?>
<br>
      <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach($codes as $code) : ?>  
      <div class="col">
        <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title text-center">Topic <?php echo $code['topic'];?></h5>
              <p class="card-text"><?php echo $code['question'];?></p>
            </div>
            <div class="text-center">
            <form action="code.php" method="POST">
			      <input type="hidden" name="id" value="<?php echo $code['topic'];?>">
			      <input type="submit" name="cp" value="Get Code" class="btn btn-success">
			      </form>  
            </div>
            </div>
            </div>
            <?php endforeach; ?>
        </div>
<br>
<!--Footer-->
<?php include('footer.php'); ?>
<!--Written by Saradwata Bandyopadhyay.-->
</html>
