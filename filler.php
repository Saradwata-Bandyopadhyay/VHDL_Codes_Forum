<!--Header and navbar-->
<?php include('header.php'); ?>
<?php
include('connect.php');
if (isset($_POST["author"]) && isset($_POST["tags"]) && isset($_POST["question"]) && isset($_POST["answer"])) {

    // Insert a new record into the database
    $sql1 = "INSERT INTO `codes` (`id`, `author`, `tags`, `question`, `answer`, `comments`, `ts`) VALUES (NULL, ?, ?, ?, ?, NULL, current_timestamp())";

    $stmt1 = mysqli_prepare($conn, $sql1);
    mysqli_stmt_bind_param($stmt1, "ssss", $author, $tags, $question, $answer);
    $result1 = mysqli_stmt_execute($stmt1);

    if ($result1) {
        // Successfully Data Inserted
        echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data inserted successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } else {
        // Data Insertion Failed
        echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Database error. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}
?>
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-sm p-4 w-50" style="max-width: 400px;">
        <h2 class="text-center mb-4">VHDL Data Filler</h2>
        <form action="filler.php" method="post">
            <div class="mb-3">
                <label for="author" class="form-label">Author *</label>
                <input type="text" class="form-control" id="author" placeholder="Author" name="author" required>
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags *</label>
                <input type="text" class="form-control" id="tags" placeholder="Tags" name="tags" required>
            </div>
            <div class="mb-3">
                <label for="question" class="form-label">Question *</label>
                <input type="text" class="form-control" id="question" placeholder="Question" name="question" required>
            </div>
            <div class="mb-3">
                <label for="answer" class="form-label">Answer *</label>
                <textarea class="form-control" id="answer" rows="3" name="answer" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>
<!--Footer-->
<?php include('footer.php'); ?>