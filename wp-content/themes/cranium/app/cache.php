<?php

defined('CACHE_DIR')     or define('CACHE_DIR', ABSPATH.'cache');
defined('CACHE_EXPIRES') or define('CACHE_EXPIRES', 86400);
defined('CACHE_ENCRYPT') or define('CACHE_ENCRYPT', false);

class Cache {

    protected static $dir = CACHE_DIR;
    protected static $expires = CACHE_EXPIRES;
    protected static $encrypt = CACHE_ENCRYPT;

    private static function name($key) {
        $filename = (self::$encrypt) ? sha1($key) : $key;
        return sprintf("%s/%s", self::$dir, $filename);
    }

    public static function get($key, $expires = null) {

        $dir = self::$dir;
        $expires = (is_int($expires)) ? $expires : self::$expires;

        if (!is_dir($dir) || !is_writable($dir)) {
            return false;
        }

        $file = self::name($key);

        if (!file_exists($file)) {
            return false;
        }

        if (filemtime($file) < (time() - $expires)) {
            self::clear($key);
            return false;
        }

        if (!$handle = fopen($file, 'rb')) {
            return false;
        }

        flock($handle, LOCK_SH);
        $filesize = filesize($file);
        $data = ($filesize > 0) ? unserialize(fread($handle, $filesize)) : null;
        flock($handle, LOCK_UN);
        fclose($handle);

        return $data;
    }

    public static function set($key, $data) {

        $dir = self::$dir;

        if (!is_dir($dir) || !is_writable($dir)) {
            error_log('CACHE_DIR '.CACHE_DIR.' does not exist or is not writeable ');
            return false;
        }

        $file = self::name($key);

        if (!$handle = fopen($file, 'wb')) {
            return false;
        }

        if (!flock($handle, LOCK_EX)) {
            return false;
        }

        fwrite($handle, serialize($data));
        flock($handle, LOCK_UN);
        fclose($handle);
        chmod($file, 0777);

        return true;
    }

    public static function clear($key = null) {
        // TODO: if (!$key) clear all files in cache dir
        $file = self::name($key);
        if (file_exists($file)) return unlink($file);
        return false;
    }
}