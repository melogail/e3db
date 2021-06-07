<?php


namespace App\traits;


use App\Models\Django\FbUser;

trait UsersDetails
{

    /**
     * Get user details from Django database
     *
     * @param $user
     * @param bool $username
     * @return mixed
     */
    public function getUserDetails($user, $username = false)
    {
        $user = json_decode(json_encode($user, JSON_UNESCAPED_UNICODE));

        // Check if variable is in JSON format
        if (is_object($user)) {
            if ($user->user_id == null) {
                $u = FbUser::where('user_name', utf8_encode($user->user_username))->first(['mobile', 'name', 'position', 'location', 'hometown']);
                if ($u) {
                    return $u->toJson(JSON_UNESCAPED_UNICODE);
                }
            }

            $u = FbUser::where('fb_id', $user->user_id)->first(['mobile', 'name', 'position', 'location', 'hometown']);
            if ($u) {
                return $u->toJson(JSON_UNESCAPED_UNICODE);
            }
        } else {    // If variable contains normal data

            if ($username) {
                $u = FbUser::where('user_name', $user)->first(['mobile', 'name', 'position', 'location', 'hometown']);
                if ($u) {
                    return $u->toJson(JSON_UNESCAPED_UNICODE);
                }
            }

            $u = FbUser::where('fb_id', $user)->first(['mobile', 'name', 'position', 'location', 'hometown']);
            if ($u) {
                return $u->toJson(JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
