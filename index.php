<!--Header and navbar-->
<?php include('header.php'); ?>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/VHDL_Codes_Forum">VHDL Codes Forum</a>
        </div>
    </nav>
    <!--Body-->
    <div class="container pt-4 pb-4">
        <div class="row align-items-center">
            <div class="col-md order-2 order-md-1">
                <h1 class="text-white pb-2 pt-2">What is VHDL ?</h1>
                <p class="text-light">
                    VHDL (VHSIC Hardware Description Language) is a hardware description language that can model the
                    behavior and structure of digital systems at multiple levels of abstraction, ranging from the system
                    level down
                    to that of logic gates, for design entry, documentation, and verification purposes. The language was
                    developed for the US military VHSIC program in the 1980s, and has been standardized by the Institute
                    of
                    Electrical and Electronics Engineers (IEEE) as IEEE Std 1076; the latest version of which is IEEE
                    Std
                    1076-2019. To model analog and mixed-signal systems, an IEEE-standardized HDL based on VHDL called
                    VHDL-AMS (officially IEEE 1076.1) has been developed. <a href="https://en.wikipedia.org/wiki/VHDL"
                        target="_blank">Read
                        More..</a></p>
                <h2 class="text-white pb-2">What to expect here ?</h2>
                <p class="text-light">Most commonly asked VHDL programs with solutions, tried and tested using ModelSim.
                </p>
                <div class="col pb-2">
                    <a type="button" class="btn btn-lg btn-success" href="questions.php" role="button">Get Questions</a>
                </div>
            </div>
            <div class="col-md order-1 order-md-2">
                <img src="resources/vhdl.jpg" class="img-fluid" alt="VHDL" width="auto" height="auto">
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center pt-2">
                <div class="ratio ratio-21x9">
                    <iframe src="https://www.youtube.com/embed/h4ZXge1BE80?list=PLIbRYKjjYOPkhpxnkQ0fwTXnmgsiCMcVV"
                        title="How to create your first VHDL program: Hello World!" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!--Footer-->
    <?php include('footer.php'); ?>