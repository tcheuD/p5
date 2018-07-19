/* php
require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';
require_once __DIR__.'./login.php';
function tryAttempt(array $request = []) {
    require loadTemplate('login.php');

    if ($request["pseudo"] && $request["password"]) {

        $apc_key = "{$_SERVER['SERVER_NAME']}~login:{$_SERVER['REMOTE_ADDR']}";
        $apc_blocked_key = "{$_SERVER['SERVER_NAME']}~login-blocked:{$_SERVER['REMOTE_ADDR']}";

        $tries = (int)apc_fetch($apc_key);
        if ($tries >= 10) {
            header("HTTP/1.1 429 Too Many Requests");
            echo "You've exceeded the number of login attempts. We've blocked IP address {$_SERVER['REMOTE_ADDR']} for a few minutes.";
            exit();
        }
        var_dump($tries);

        $pseudo = $request["pseudo"];
        $password = $request["password"];

        $success = login($pseudo, $password);
        var_dump($success);

        if (!$success) {
            $blocked = (int)apc_fetch($apc_blocked_key);

            apc_store($apc_key, $tries + 1, pow(2, $blocked + 1) * 60);  # store tries for 2^(x+1) minutes: 2, 4, 8, 16, ...
            apc_store($apc_blocked_key, $blocked + 1, 86400);  # store number of times blocked for 24 hours
        } else {
            apc_delete($apc_key);
            apc_delete($apc_blocked_key);
        }
    }
}
*/