<footer class="bg-body-tertiary text-light text-center py-3" data-bs-theme="dark">
    <div class="container">
        <p class="mb-0">
            VHDL Codes Forum &copy;
            <?php echo date("Y"); ?> | Copyright : VHDL Codes Forum built by <a
                href="https://github.com/Saradwata-Bandyopadhyay" target="_blank" class="text-danger">Saradwata</a>
        </p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
<script>
    function sendOTP() {
        var email = document.getElementById('signupEmail').value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'send_otp.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById('alert-container').innerHTML = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                OTP sent successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`;
                    } else {
                        document.getElementById('alert-container').innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Error sending OTP: ${response.error}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`;
                    }
                } catch (error) {
                    document.getElementById('alert-container').innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error parsing JSON response. Please try again.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                }
            } else {
                document.getElementById('alert-container').innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error sending OTP. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
            }
        };
        xhr.send('email=' + email);
    }
</script>
<script>
    function copyCode() {
        // Select the code block
        const code = document.querySelector('#codeBlock').innerText;

        // Copy to clipboard
        navigator.clipboard.writeText(code).then(() => {
            alert('Code copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }
</script>
</body>

</html>