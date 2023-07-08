<?php

    function sanitize_data($content){
        return trim(htmlspecialchars(stripcslashes($content)));
    }


?>