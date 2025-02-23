<?php
 session_start(); 
 
if (!isset($_SESSION['alogin']) || (trim($_SESSION['alogin']) == '')) { ?>
    <script>
    window.location = "../index.php";
    </script>
    <?php
    }
$session_id=$_SESSION['alogin'];
$session_grade_level=$_SESSION['grade_level'];
$session_section=$_SESSION['section'];

?>