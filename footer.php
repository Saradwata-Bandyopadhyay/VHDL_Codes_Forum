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