<?php


namespace app\core\Database;

class DB extends Core {
    public function show() {
        print_r(Core::connection());
    }
}