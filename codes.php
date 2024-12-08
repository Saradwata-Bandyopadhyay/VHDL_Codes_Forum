<?php
include('connect.php');
if (isset($_POST['id'])) {
  $topic = mysqli_real_escape_string($conn, $_POST['id']);
  $sql = "SELECT * FROM `vhdl_codes_forum` WHERE `topic` = '$topic'";
  if (!$sql) {
    echo 'sql error: ' . mysqli_connect_error();
  }
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    echo 'result error: ' . mysqli_connect_error();
  }
  $code = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  mysqli_close($conn);
}
?>
<!--Header and navbar-->
<?php include('header.php'); ?>
<div class="container pt-4 pb-4">
  <div class="accordion">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
          data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
          Accordion Item #1
        </button>
      </h2>
      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
        <div class="accordion-body">
          <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin
          adds the appropriate classes that we use to style each element. These classes control the overall appearance,
          as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or
          overriding our default variables. It's also worth noting that just about any HTML can go within the
          <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
          Accordion Item #2
        </button>
      </h2>
      <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
        <div class="accordion-body">
          <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin
          adds the appropriate classes that we use to style each element. These classes control the overall appearance,
          as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or
          overriding our default variables. It's also worth noting that just about any HTML can go within the
          <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
          aria-controls="panelsStayOpen-collapseThree">
          Accordion Item #3
        </button>
      </h2>
      <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
        <div class="accordion-body">
          <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin
          adds the appropriate classes that we use to style each element. These classes control the overall appearance,
          as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or
          overriding our default variables. It's also worth noting that just about any HTML can go within the
          <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-->
<?php include('footer.php'); ?>