<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */
namespace SLS\Models;
/**
 * The QueriedLog is a log of the GetLogsResponse which obtained from the log.
 *
 * @author log service dev
 */
class QueriedLog {

    /**
     * @var integer log timestamp
     */
    private $time;

    /**
     * @var string log source
     */
    private $source;

    /**
     * @var array log contents, content many key/value pair
     */
    private $contents;
    
    
    /**
     * QueriedLog constructor
     *
     * @param integer $time
     *            log time stamp
     * @param string $source
     *            log source
     * @param array $contents
     *            log contents, content many key/value pair
     */
    public function __construct($time, $source, $contents) {
        $this->time = $time;
        $this->source = $source;
        $this->contents = $contents; // deep copy
    }
    
    /**
     * Get log source
     *
     * @return string log source
     */
    public function getSource() {
        return $this->source;
    }
    
    /**
     * Get log time
     *
     * @return integer log time
     */
    public function getTime() {
        return $this->time;
    }
    
    /**
     * Get log contents, content many key/value pair.
     *
     * @return array log contents
     */
    public function getContents() {
        return $this->contents;
    }
}
