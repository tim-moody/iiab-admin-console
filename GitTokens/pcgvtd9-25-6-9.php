<?php
    header("Content-Type: application/json; charset=UTF-8");
    $iiab_user_control = json_decode(file_get_contents('/srv2/private/iiab_user_control.json'), true);
    $update_allowed = $iiab_user_control['update_allowed'] ?? false;
    $banned_ips = $iiab_user_control['banned_ips'] ?? [];
    $user_ip = $_SERVER['REMOTE_ADDR'];
    if (!$update_allowed || in_array($user_ip, $banned_ips)) {
        $iiab_user_data = json_decode(file_get_contents('/srv2/private/iiab_user_ro_pat.json'), true);
    } else {
        $iiab_user_data = json_decode(file_get_contents('/srv2/private/iiab_user_rw_pat.json'), true);
    }
    $iiab_user_data["iiab_user_ip"] = $user_ip;
    $resp = json_encode($iiab_user_data);

    echo $resp;
?>
