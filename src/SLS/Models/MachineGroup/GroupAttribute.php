<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */
namespace SLS\Models\MachineGroup;
class GroupAttribute {
    public $externalName;
    public $groupTopic;
    public function __construct($externalName=null,$groupTopic=null){
      $this->externalName = $externalName;
      $this->groupTopic = $groupTopic;
    }
    public function toArray(){
      $resArray = array();
      if($this->externalName!==null)
        $resArray['externalName'] = $this->externalName;
      if($this->groupTopic!==null)
        $resArray['groupTopic'] = $this->groupTopic;
      return $resArray;
    }
}
