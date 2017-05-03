<?php

/**
 * PHPUnit 6.x is not compatible with 5.x. This autoloader
 * will create classes compatible from 5.x if the current 
 * PHPUnit is 6.x
 */
function phpunit_compat_autoloader() {
    if (preg_match('@^phpunit_@i', $class)) {
        $new_class  = str_replace("_", "\\", $class);
        $reflection = new ReflectionClass($new_class);
        $type       = $reflection->isAbstract() ? 'abstract class' : 'class';
        eval("$type $class extends $new_class {}");
    }
}

spl_autoload_register('phpunit_compat_autoloader');
