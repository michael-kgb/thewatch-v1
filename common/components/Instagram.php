<?php

namespace common\components;

use Yii;
use yii\base\Component;

class Instagram extends Component {
    
    /*
     * Get all post from instagram thewatchco
     * @params next_max_id for pagination
     */
    
    public static function getAllMedia($next_max_id = NULL) {
        if(!empty($next_max_id)){
            $media = file_get_contents("https://api.instagram.com/v1/users/22192614/media/recent/?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1&max_id=" . $next_max_id);
        }
        else{
            $media = file_get_contents("https://api.instagram.com/v1/users/22192614/media/recent/?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1");
        }
        
        return json_decode($media);
    }
}
