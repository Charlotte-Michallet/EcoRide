<?php
    //
    ini_set("session.use_only_cookies", 1);
    ini_set("session.use_strict_mode", 1);

    session_start();

    // regenarate id for more security
    if (! isset($_SERVER["last_regeneration"])) {
        regenarateSessionId();
    } else {
        // initiate variable to 30minites (60s * 30min)
        $interval = 60 * 30;

        if (time() - $_SERVER["last_regeneration"] >= $interval) {
            // regenarate session id if last session id is more than 30min
            regenarateSessionId();
        }
    }

    function regenarateSessionId()
    {
        session_regenerate_id(true);
        $_SERVER["last_regeneration"] = time();
}