<?php
echo "
<script>
    function confirmation() {
        var result = confirm('Are you sure about this?');
        if (result) {
            window.location.href = '../website/student-information.php';
        } else {
            return false;
        }
    }
</script>
";
?>