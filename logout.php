<?php
//ends session and returns to index.php
session_start();

session_unset();
session_destroy();

header("Location: templates/index.php");