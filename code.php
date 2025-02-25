<?php session_start();
include('connect.php');
if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
  header("Location: questions.php"); // Redirect to questions page 
  exit();
}
$id = mysqli_real_escape_string($conn, $_GET['id']); // Fetch code details 
$sql = "SELECT * FROM codes WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$codes = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result); // Fetch comments
$sql1 = "SELECT * FROM comments WHERE codeid = '$id'";
$result1 = mysqli_query($conn, $sql1);
$comments = mysqli_fetch_all($result1, MYSQLI_ASSOC);
mysqli_free_result($result1);
$errors = [];
$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['action']) && $_POST['action'] == "login") {
    $email = mysqli_real_escape_string($conn, trim($_POST['login_email']));
    $password = trim($_POST['login_password']);
    if (empty($email) || empty($password)) {
      $errors[] = "Email and Password are required for login.";
    } else {
      $query = "SELECT * FROM users WHERE emailid = '$email'";
      $result2 = mysqli_query($conn, $query);
      if (mysqli_num_rows($result2) == 1) {
        $user = mysqli_fetch_assoc($result2);
        if (
          password_verify(
            $password,
            $user['password']
          )
        ) {
          $_SESSION['user_id'] = $user['userid'];
          $_SESSION['user_name'] = $user['username'];
          header("Location:code.php?id=$id");
          exit();
        } else {
          $errors[] = "Invalid Password.";
        }
      } else {
        $errors[] = "User not found.";
      }
    }
  } elseif (isset($_POST['action']) && $_POST['action'] == "signup") {
    $name = mysqli_real_escape_string($conn, trim($_POST['signup_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['signup_email']));
    $password = trim($_POST['signup_password']);
    $confirm_password = trim($_POST['signup_confirm_password']);
    if (
      empty($name) || empty($email) || empty($password) ||
      empty($confirm_password)
    ) {
      $errors[] = "All fields are required for signup.";
    } elseif (
      !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
      $errors[] = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
      $errors[] = "Passwords do not match.";
    } else {
      $check_email = "SELECT userid FROM users WHERE emailid = '$email'";
      $check_result = mysqli_query($conn, $check_email);
      if (mysqli_num_rows($check_result) > 0) {
        $errors[] = "Email is already registered.";
      } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users (emailid, username, password, ts) VALUES ('$email', '$name', '$hashed_password',
  current_timestamp())";

        if (mysqli_query($conn, $insert_query)) {
          $success = "Registration successful! You can now log in.";
        } else {
          $errors[] = "Error: " . mysqli_error($conn);
        }
      }
    }
  } elseif (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: code.php?id=$id");
    exit();
  } elseif (isset($_POST['action']) && $_POST['action'] == "comment") {
    $comment = mysqli_real_escape_string($conn, trim($_POST['comment']));
    if (empty($comment)) {
      $errors[] = "Empty Comment!!!";
    } else {
      $insert_query = "INSERT INTO comments (codeid, userid, username, comment, ts) 
                         VALUES ('$id', '$_SESSION[user_id]', '$_SESSION[user_name]', '$comment', current_timestamp())";

      if (mysqli_query($conn, $insert_query)) {
        // Redirect after successful comment submission to prevent duplicate inserts
        header("Location: code.php?id=$id");
        exit();
      } else {
        $errors[] = "Error: " . mysqli_error($conn);
      }
    }
  }
}
?>
<!--Header and navbar-->
<?php include('header.php'); ?>

<body class="bg-dark">
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/VHDL_Codes_Forum">VHDL Codes Forum</a>
      <div class="navbar-nav">
        <?php if (!empty($_SESSION['user_name'])): ?>
          <form method="POST" style="display: inline;">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
          </form>
        <?php else: ?>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#darkModal">Login</button>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <div class="container pt-4 pb-4">
    <!-- Display Errors or Success Messages -->
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php foreach ($errors as $error): ?>
          <h2 class="text-center"><?= htmlspecialchars($error) ?></h2>
        <?php endforeach; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h2 class="text-center"><?= htmlspecialchars($success) ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <!-- Login Modal -->
    <div class="modal fade" id="darkModal" tabindex="-1" aria-labelledby="darkModalLabel" aria-hidden="false">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">

          <!-- Centered Modal Header -->
          <div class="modal-header border-secondary d-flex justify-content-center w-100">
            <h1 class="modal-title fs-5" id="darkModalLabel">Login</h1>
          </div>

          <div class="modal-body">
            <form action="code.php?id=<?php echo $id ?>" method="POST">

              <input type="hidden" name="action" value="login">
              <!-- Email Input -->
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control bg-secondary text-light" id="email" name="login_email"
                  placeholder="Enter your email" maxlength="50" required>
              </div>

              <!-- Password Input -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control bg-secondary text-light" id="password" name="login_password"
                  placeholder="Enter your password" minlength="6" maxlength="10" required>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
          </div>

          <!-- Centered Modal Footer -->
          <div class="modal-footer border-secondary d-flex justify-content-center w-100">
            <p class="m-0">Don't have an account?
              <a href="#" class="text-info" data-bs-toggle="modal" data-bs-target="#signupModal"
                data-bs-dismiss="modal">
                Sign up
              </a>
            </p>
          </div>

        </div>
      </div>
    </div>

    <!-- Signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="false">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">

          <!-- Centered Modal Header -->
          <div class="modal-header border-secondary d-flex justify-content-center w-100">
            <h1 class="modal-title fs-5" id="signupModalLabel">Sign Up</h1>
          </div>

          <div class="modal-body">
            <form action="code.php?id=<?php echo $id ?>" method="POST">
              <input type="hidden" name="action" value="signup">
              <!-- Name Input -->
              <div class="mb-3">
                <label for="name" class="form-label">User Name</label>
                <input type="text" class="form-control bg-secondary text-light" id="name" name="signup_name"
                  placeholder="Enter user name" maxlength="50" required>
              </div>

              <!-- Email Input -->
              <div class="mb-3">
                <label for="signupEmail" class="form-label">Email id</label>
                <input type="email" class="form-control bg-secondary text-light" id="signupEmail" name="signup_email"
                  placeholder="Enter your email" maxlength="50" required>
              </div>

              <!-- Password Input -->
              <div class="mb-3">
                <label for="signupPassword" class="form-label">Password</label>
                <input type="password" class="form-control bg-secondary text-light" id="signupPassword"
                  name="signup_password" placeholder="Create a password" minlength="6" maxlength="10" required>
              </div>

              <!-- Confirm Password Input -->
              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control bg-secondary text-light" id="confirmPassword"
                  name="signup_confirm_password" placeholder="Confirm your password" minlength="6" maxlength="10"
                  required>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            </form>
          </div>

          <!-- Centered Modal Footer -->
          <div class="modal-footer border-secondary d-flex justify-content-center w-100">
            <p class="m-0">Already have an account?
              <a href="#" class="text-info" data-bs-toggle="modal" data-bs-target="#darkModal" data-bs-dismiss="modal">
                Login
              </a>
            </p>
          </div>

        </div>
      </div>
    </div>
    <div class="container text-white p-4">
      <?php foreach ($codes as $code):
        $id = htmlspecialchars_decode($code['id']);
        $author = htmlspecialchars_decode($code['author']);
        $tags = htmlspecialchars_decode($code['tags']);
        $question = htmlspecialchars_decode($code['question']);
        $answer = htmlspecialchars_decode($code['answer']);
        $codelink = htmlspecialchars_decode($code['codelink']);
        $softwarelink = htmlspecialchars_decode($code['softwarelink']);
        $ts = htmlspecialchars_decode($code['ts']);
        ?>
        <!-- Question Section -->
        <h4 class="text-info">Question:</h4>
        <h1 class="mb-4"><?php echo $question; ?></h1>
        <!-- Tags and Author name -->
        <p class="text-white">Posted by <strong><?php echo $author; ?></strong> on
          <?php
          $sdate = strtotime($ts);
          $date = date("d-m-Y", $sdate);
          echo '<strong>';
          echo $date;
          echo '</strong>'; ?>
        <div class="d-flex flex-wrap gap-2">
          <?php
          $array = array_filter(array_map('trim', explode(",", $tags)));
          usort($array, function ($a, $b) {
            return strlen($b) - strlen($a);
          });
          echo "<strong>Tags : </strong>";
          foreach ($array as $a): ?>
            <span class="badge bg-info text-dark fw-semibold px-3 py-2"><?php echo $a; ?></span>
          <?php endforeach; ?>
        </div>
        </p>
        <!-- Answer Section -->
        <div class="mb-4">
          <h4 class="text-success">Answer:</h4>
          <p>Here is the solution for the above question =></p>
          <div class="position-relative">
            <pre id="codeBlock" class="bg-dark text-white p-3 rounded border border-light">
            <code><?php echo htmlspecialchars($answer); ?></code></pre>
            <button class="btn btn-sm btn-info position-absolute top-0 end-0" onclick="copyCode()">Copy Code</button>
          </div>
          <p>You can directly download the <code>Source Code</code> and the <code>Model Sim</code> application from the
            links below =></p>
        </div>

        <!-- Download Buttons -->
        <div class="d-flex flex-wrap gap-2 mb-4">
          <a href="<?php echo $codelink; ?>" class="btn btn-info me-2">Download Code</a>
          <a href="<?php echo $softwarelink; ?>" class="btn btn-info me-2">Download Model Sim</a>
        </div>
      <?php endforeach; ?>
      <h4>Add a Comment</h4>
      <?php if (!empty($_SESSION['user_name'])): ?>
        <h6>Posting comment as <code><?php echo htmlspecialchars($_SESSION['user_name']); ?></code></h6>
        <form action="code.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
          <input type="hidden" name="action" value="comment">
          <div class="mb-3">
            <div class="pt-3">
              <label for="comment" class="form-label">Type your Comment here *</label>
              <textarea class="form-control bg-dark text-white" id="comment" rows="3" name="comment" maxlength="500" minlength="4"
                required></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-info">Submit</button>
        </form>
      <?php else: ?>
        <strong>
          <h5>Please <code>Login</code> to Comment.</h5>
        </strong>
      <?php endif; ?>

      <!-- Comments Section -->
      <?php if (!empty($comments)): ?>
        <div class="mt-5">
          <h4>Comments (<?= count($comments) ?>)</h4>

          <!-- Scrollable Comment Box -->
          <div class="comment-container border rounded p-3 bg-dark text-white"
            style="max-height: 400px; overflow-y: auto;">

            <?php foreach ($comments as $index => $c): ?>
              <?php
              $username = htmlspecialchars($c['username']);
              $comment = htmlspecialchars($c['comment']);
              $ts = htmlspecialchars($c['ts']);
              ?>

              <!-- Comment Tile -->
              <div class="comment-card rounded mb-3 p-3 bg-secondary border-light">
                <div class="d-flex align-items-start">
                  <!-- User Avatar -->
                  <img src="resources/user.jpg" width="50" height="50" alt="User"
                    class="rounded-circle me-3 border border-light">

                  <!-- Comment Content -->
                  <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center">
                      <h6 class="mb-1 text-info"><?= $username; ?></h6>
                      <small class="text-white"><?= date("d M Y", strtotime($ts)); ?></small>
                    </div>
                    <p class="mb-0"><?= nl2br($comment); ?></p>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>

          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>
  <!--Footer-->
  <?php
  include('footer.php');
  mysqli_close($conn);
  ?>