<?php

namespace Predis;
class Client {
    public function __call($name, $args) {}
}

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(dirname(__DIR__) . '/lib'),
    get_include_path(),
)));

require 'Elvis/Autoloader.php';

\Elvis\Autoloader::register();
