<?php

namespace Dsprog;

use Rain\Tpl;

class Page
{
    private $tpl;
    private $options = [];
    private $defaults = [
        "data"=>[]
    ];

    public function __construct($opts = [])
    {
        $this->options = array_merge($this->defaults, $opts);
        $config = array(
            "tpl_dir"       =>  __DIR__ . "/../views/templates/site/",
            "cache_dir"     => __DIR__ . "/../views/cache/site/",
            "debug"         => false
        );
        Tpl::configure( $config );

        $this->tpl = new Tpl;
        $this->setData($this->options['data']);
        $this->tpl->draw('header');       
    }

    private function setData($data = [])
    {
        foreach($data as $k => $v){
            $this->tpl->assign($k, $v);
        }
    }

    public function setView($view, $data=[], $returnHTML = false)
    {
        $this->setData($data);
        return $this->tpl->draw($view, $returnHTML);
    }

    public function __destruct()
    {
        $this->tpl->draw('footer');
    }
}