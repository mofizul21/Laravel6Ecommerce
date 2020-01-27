<?php

namespace App\Helpers;

class GravatarHelper{
    /**
     * Check there have gravatar for the email
     */
    public static function validate_gravatar($email){
        $hash = md5($email);
        $uri = 'http://gravatar.com/avatar/'.$hash.'?d=404';
        $headers = @get_headers($uri);
        if (!preg_match("|200|", $headers[0])) {
            $has_valid_avatar = false;
        }else{
            $has_valid_avatar = true;
        }

        return $has_valid_avatar;
    }

    /**
     * Get the gravatar image from an email
     */
    public static function gravatar_image($email, $size=0, $d=""){
        $hash = md5($email);
        $image_url = 'http://gravatar.com/avatar/' . $hash . '?s'.$size.'&d='.$d;
        return $image_url;
    }

}