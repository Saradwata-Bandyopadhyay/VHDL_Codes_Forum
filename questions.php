<?php
include('connect.php');

$codes = [];
$errors = [];

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, trim($_GET['search']));

    if (empty($search)) {
        $errors[] = "Empty Search!!!";
    } else {
        // Query with improved LIKE clause (fixed missing $ sign in 'search')
        $sql1 = "SELECT * FROM `codes` WHERE `tags` LIKE '%$search%' OR `question` LIKE '%$search%'";
        $result1 = mysqli_query($conn, $sql1);

        if ($result1) {
            $codes = mysqli_fetch_all($result1, MYSQLI_ASSOC);
            mysqli_free_result($result1);

            if (empty($codes)) {
                $errors[] = "No records found for your Search term '$search'";
            }
        } else {
            $errors[] = "Error: " . mysqli_error($conn);
        }
    }
}

// Fetch all records if no search query or no results found
if (empty($codes)) {
    $sql = "SELECT * FROM `codes`";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $codes = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
    } else {
        die('Query failed: ' . mysqli_error($conn));
    }
}

mysqli_close($conn);
?>

<!-- Header and navbar -->
<?php include('header.php'); ?>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/VHDL_Codes_Forum">VHDL Codes Forum</a>
            <div class="navbar-nav">
                <form action="questions.php" class="d-flex" role="search" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search Questions" id="search"
                        name="search" aria-label="Search" maxlength="50" minlength="3">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Questions List Section -->
    <section class="py-5">
        <div class="container">
            <!-- Display Errors -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php foreach ($errors as $error): ?>
                        <h2 class="text-center"><?= htmlspecialchars($error) ?></h2>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <!-- Questions -->
                <?php foreach ($codes as $code): ?>
                    <div class="col-md-4 mb-4">
                        <a href="code.php?id=<?= htmlspecialchars($code['id']); ?>" class="text-decoration-none">
                            <div class="card h-100 bg-dark text-white border-light shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= htmlspecialchars_decode($code['question']); ?></h5>
                                    <hr class="border border-white border-2">
                                    <p class="mb-2"><strong>Author:</strong>
                                        <?= htmlspecialchars_decode($code['author']); ?></p>

                                    <!-- Tags Section -->
                                    <?php
                                    $tagsArray = array_filter(array_map('trim', explode(",", $code['tags'])));
                                    usort($tagsArray, fn($a, $b) => strlen($b) - strlen($a));
                                    if (!empty($tagsArray)):
                                        ?>
                                        <div class="d-flex flex-wrap gap-2">
                                            <strong>Tags:</strong>
                                            <?php foreach ($tagsArray as $tag): ?>
                                                <span
                                                    class="badge bg-info text-dark fw-semibold px-3 py-2"><?= htmlspecialchars($tag); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('footer.php'); ?>