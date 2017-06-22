<?php
/**
 * Created by PhpStorm.
 * User: Caio H. Clemente
 * Date: 19/06/2017
 * Time: 22:37
 */

namespace Hcode;
use Rain\Tpl;
class Page
{
    private $tpl;
    private $options = [];
    private $defaults = [
        "data"=>[]
];

    public function __construct($opts = array())
    {
        $this->options = array_merge($this->defaults, $opts);
        $config = array(
            "tpl_dir" => $_SERVER["DOCUMENT_ROOT"] . "/views/",
            "cache_dir" => $_SERVER["DOCUMENT_ROOT"] . "/views-cache/",
            "debug" => false // set to false to improve the speed
        );

        Tpl::configure( $config );
        $this->tpl = new Tpl;
        $this->setData($this->options["data"]);
        $this->tpl->draw("header");
        }
    private function setData($data = array())
    {
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }
    public function setTpl($name, $data = array(), $returnHTML = false){
        $this->setData();
        $this->tpl->draw($name, $returnHTML);
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->tpl->draw("footer");
    }
}
