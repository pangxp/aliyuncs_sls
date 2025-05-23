<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */
namespace SLS\Models\LogLevel;
class LogLevel{
    const debug = 'debug';
    const info = 'info';
    const warn = 'warn';
    const error = 'error';

    private static $constCacheArray = NULL;

    private $level;

    /**
     * Constructor
     *
     * @param string $level
     */
    private function __construct($level) {
        $this->level = $level;
    }

    /**
     * Compares two logger levels.
     *
     * @param LoggerLevels $other
     * @return boolean
     */
    public function equals($other) {
        if($other instanceof LogLevel) {
            if($this->level == $other->level) {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function getLevelDebug(){
        if(!isset(self::$constCacheArray[LogLevel::debug])){
            self::$constCacheArray[LogLevel::debug] = new LogLevel('debug');
        }
        return self::$constCacheArray[LogLevel::debug];
    }

    public static function getLevelInfo(){
        if(!isset(self::$constCacheArray[LogLevel::info])){
            self::$constCacheArray[LogLevel::info] = new LogLevel('info');
        }
        return self::$constCacheArray[LogLevel::info];
    }

    public static function getLevelWarn(){
        if(!isset(self::$constCacheArray[LogLevel::warn])){
            self::$constCacheArray[LogLevel::warn] = new LogLevel('warn');
        }
        return self::$constCacheArray[LogLevel::warn];
    }

    public static function getLevelError(){
        if(!isset(self::$constCacheArray[LogLevel::error])){
            self::$constCacheArray[LogLevel::error] = new LogLevel('error');
        }
        return self::$constCacheArray[LogLevel::error];
    }

    public static function getLevelStr(LogLevel $logLevel){

        $logLevelStr = '';
        if(null === $logLevel){
            $logLevelStr = 'info';
        }
        switch ($logLevel->level){
            case "error":
                $logLevelStr= 'error';
                break;
            case "warn":
                $logLevelStr= 'warn';
                break;
            case "info":
                $logLevelStr= 'info';
                break;
            case "debug":
                $logLevelStr= 'debug';
                break;
        }
        return $logLevelStr;
    }
}