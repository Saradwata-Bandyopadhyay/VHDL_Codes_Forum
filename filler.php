<?php include('header.php'); ?>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/VHDL_Codes_Forum">VHDL Codes Forum</a>
            <div class="navbar-nav">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search Codes" id="search"
                        aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <?php
    include('connect.php');

    if (isset($_POST["author"]) && isset($_POST["tags"]) && isset($_POST["question"]) && isset($_POST["answer"]) && isset($_POST["codelink"]) && isset($_POST["softwarelink"])) {
        // Sanitize input
        $author = htmlspecialchars($_POST["author"], ENT_QUOTES, 'UTF-8');
        $tags = htmlspecialchars($_POST["tags"], ENT_QUOTES, 'UTF-8');
        $question = htmlspecialchars($_POST["question"], ENT_QUOTES, 'UTF-8');
        $answer = htmlspecialchars($_POST["answer"], ENT_QUOTES, 'UTF-8');
        $codelink = htmlspecialchars($_POST["codelink"], ENT_QUOTES, 'UTF-8');
        $softwarelink = htmlspecialchars($_POST["softwarelink"], ENT_QUOTES, 'UTF-8');

        // Insert a new record into the database
        $sql1 = "INSERT INTO `codes` (`id`, `author`, `tags`, `question`, `answer`, `codelink`, `softwarelink`, `ts`) VALUES (NULL,?,?,?,?,?,?,current_timestamp())";

        $stmt1 = mysqli_prepare($conn, $sql1);

        if ($stmt1) {
            mysqli_stmt_bind_param($stmt1, "ssssss", $author, $tags, $question, $answer, $codelink, $softwarelink);
            $result1 = mysqli_stmt_execute($stmt1);

            if ($result1) {
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data inserted successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Database error: ' . mysqli_error($conn) . '.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Failed to prepare the SQL statement: ' . mysqli_error($conn) . '.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    ?>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-sm p-4 w-100" style="max-width: 400px;">
            <h2 class="text-center mb-4">VHDL Data Filler</h2>
            <form action="filler.php" method="post">
                <div class="mb-3">
                    <label for="author" class="form-label">Author *</label>
                    <input type="text" class="form-control" id="Author" placeholder="Author" name="author"
                        value="Saradwata Bandyopadhyay" required>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags *</label>
                    <input type="text" class="form-control" id="Tags" placeholder="Tags" name="tags" required>
                </div>
                <div class="mb-3">
                    <label for="codelink" class="form-label">Code Link *</label>
                    <input type="text" class="form-control" id="Codelink" placeholder="Code Link" name="codelink"
                        required>
                </div>
                <div class="mb-3">
                    <label for="softwarelink" class="form-label">Software Link *</label>
                    <input type="text" class="form-control" id="Softwarelink" placeholder="Software Link"
                        name="softwarelink"
                        value="https://drive.google.com/file/d/1-4iEE5RQh4d9T-1seYU6TTMjkyiPoDHZ/view" required>
                </div>
                <div class="mb-3">
                    <label for="question" class="form-label">Question *</label>
                    <input type="text" class="form-control" id="Question" placeholder="Question" name="question"
                        required>
                </div>
                <div class="mb-3">
                    <label for="answer" class="form-label">Answer *</label>
                    <textarea class="form-control" id="Answer" rows="3" name="answer" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
    <?php include('footer.php'); ?>