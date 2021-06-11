<?php

namespace Dsprog;

use Rain\Tpl;

class Page
{
    private $tpl;
    private $options = [];
    private $defaults = [
        'header'=>true,
        'footer'=>true,
        "data"=>[]
    ];

    public function __construct($opts = [], $tpl_dir = 'site')
    {
        $this->options = array_merge($this->defaults, $opts);
        $config = array(
            "tpl_dir"       =>  __DIR__ . "/../views/{$tpl_dir}/",
            "cache_dir"     => __DIR__ . "/../views/cache/{$tpl_dir}/",
            "debug"         => false
        );
        Tpl::configure( $config );

        $this->tpl = new Tpl;
        $this->setData($this->options['data']);
        if($this->options['header'])
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
        if($this->options['header'])
            $this->tpl->draw('footer');
    }
}