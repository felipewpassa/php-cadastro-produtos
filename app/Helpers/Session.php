<?php

class Session {

    public static function alert($name, $text = null, $classCss = null) {
        if (!empty($name)) {
            if (!empty($text) && empty($_SESSION[$name])) {
                if(!empty($_SESSION[$name])) unset($_SESSION[$name]);
                $_SESSION[$name] = $text;
                $_SESSION[$name.'classCss'] = $classCss;
            } elseif (!empty($_SESSION[$name]) && empty($text)) {
                $classCss = !empty($_SESSION[$name.'classCss']) ? $_SESSION[$name.'classCss'] : 'alert alert-success alert-dismissible fade show';
                echo '<div id="popupAlert" class="'.$classCss.'">'.$_SESSION[$name].'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name.'classCss']);
            }
        }
    }

}