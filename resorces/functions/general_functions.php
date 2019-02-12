<?php
    function hsc ($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
?>