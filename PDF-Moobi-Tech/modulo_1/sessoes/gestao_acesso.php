<?php
session_start();

class GestaoAcesso {
    public static function setVariavel($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function getValorDaSessao($key) {
        return $_SESSION[$key] ?? null;
    }

    public static  function removeVariavel($key) {
        unset($_SESSION[$key]);
    }

    public static function destroySessao() {
        session_destroy();
    }
}
?>
