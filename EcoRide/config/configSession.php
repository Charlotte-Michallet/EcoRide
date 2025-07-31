<?php
//
ini_set("session.use_only_cookies", 1);
ini_set("session.use_strict_mode", 1);

session_start();

// regenarate id for more security
if (! isset($_SESSION["last_regeneration"])) {
    regenerateSessionId();

} else {
    // initiate variable to 30minites (60s * 30min)
    $interval = 60 * 30;

    if (time() - $_SESSION["last_regeneration"] >= $interval) {
        // regenarate session id if last session id is more than 30min
        regenerateSessionId();
    }
}

function regenerateSessionId()
{
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}
