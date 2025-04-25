<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace SLS\Models\Response;

/**
 * The response of the UpdateLogstore API from log service.
 *
 * @author log service dev
 */
class UpdateLogstoreResponse extends Response {
    
    /**
     * UpdateLogstoreResponse constructor
     *
     * @param array $resp
     *            UpdateLogstore HTTP response body
     * @param array $header
     *            UpdateLogstore HTTP response header
     */
    public function __construct($resp, $header) {
        parent::__construct ( $header );
    }
    
}
