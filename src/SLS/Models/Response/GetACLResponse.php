<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace SLS\Models\Response;
use SLS\Models\LogLevel\ACL;
/**
 * The response of the GetLog API from log service.
 *
 * @author log service dev
 */
class GetACLResponse extends Response {
    

    private $acl;
    /**
     * GetACLResponse constructor
     *
     * @param array $resp
     *            GetLogs HTTP response body
     * @param array $header
     *            GetLogs HTTP response header
     */
    public function __construct($resp, $header) {
        parent::__construct ( $header );
        $this->acl = null;
        if($resp!==null){
            $this->acl = new ACL();
            $this->acl->setFromArray($resp); 
        }
    }

    public function getAcl(){
        return $this->acl;
    }
   

}
