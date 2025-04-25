<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace SLS\Models\Request;

/**
 * 
 *
 * @author log service dev
 */
class DeleteConfigRequest extends Request {

    private $configName;
    /**
     * DeleteConfigRequest Constructor
     *
     */
    public function __construct($configName=null) {
        $this->configName = $configName;
    }

    public function getConfigName(){
        return $this->configName;
    }

    public function setConfigName($configName){
        $this->configName=$configName;
    }
    
}
