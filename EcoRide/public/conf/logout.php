<?php

require_once dirname(__DIR__, 2) . "/config/configSession.php";

session_unset();
session_destroy();
header("Location: ../index.php");
exit();
