<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */
namespace SLS\Models\Request;
/**
 * The base request of all log request.
 *
 * @author log service dev
 */
class Request {

    /**
     * @var string project name
     */
    private $project;
    
    /**
     * Request constructor
     *
     * @param string $project
     *            project name
     */
    public function __construct($project) {
        $this->project = $project;
    }
    
    /**
     * Get project name
     *
     * @return string project name
     */
    public function getProject() {
        return $this->project;
    }
    
    /**
     * Set project name
     *
     * @param string $project
     *            project name
     */
    public function setProject($project) {
        $this->project = $project;
    }
}
