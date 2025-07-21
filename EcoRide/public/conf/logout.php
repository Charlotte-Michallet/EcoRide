<?php

require_once dirname(dirname(__DIR__)) . "/config/configSession.php";

session_unset();
session_destroy();
header("Location: ../index.php");
exit();
