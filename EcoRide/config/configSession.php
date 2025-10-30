<?php

ini_set("session.use_only_cookies", 1);
ini_set("session.use_strict_mode", 1);

session_start();

// regenerate id for more security
if (! isset($_SESSION["last_regeneration"])) {
    regenerateSessionId();

} else {
    // initialize variable for 30 minutes
    $interval = 60 * 30;

    if (time() - $_SESSION["last_regeneration"] >= $interval) {
        // regenerate session id if last session id is more than 30min
        regenerateSessionId();
    }
}

function regenerateSessionId()
{
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}
