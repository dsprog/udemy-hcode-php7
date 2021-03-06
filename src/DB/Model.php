<?php

namespace Dsprog\DB;

class Model extends Sql
{
    private $values = [];
    
    public function __call($name, $args)
    {
        $method = substr($name, 0, 3);
        $fieldName = substr($name, 3, strlen($name));

        switch($method)
        {
            case 'get':
                return $this->values[$fieldName];
            break;

            case 'set':
                return $this->values[$fieldName] = $args[0];
            break;
        }
    }

    public function setData($data = [])
    {
        foreach($data as $k => $v){
            $this->{'set'.$k}($v);
        }
    }

    public function getValues(){
        return $this->values;
    }

}