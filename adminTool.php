<script>
    function protect() {
        let dataRole = "<?php echo $_SESSION['role']?>";

        if (dataRole !== 'admin') {
            $('.adminTool').hide();
        } else {
            $('.adminTool').show();
        }
    }
</script>
