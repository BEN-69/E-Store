<?php

namespace MVC\Lib\Html;


class Form {
        
    protected $data;
    protected $surround = 'p';

    /**
     * @param array $data
     */
    public function __construct($data = array()) {

        $this -> data = $data;
    }

    /**
     * @param $html
     * @return string
     */
    public function surround($html) {

        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    /**
     * @param $index
     * @return null
     */
    public function getValue($index) {


        if(is_object($this->data)){

            return $this->data->$index;
        }


        return isset($this -> data[$index]) ? $this -> data[$index] : null;
    }

    /**
     * @param $name
     * @param $label
     * @return string
     */
    public function input($name,$label,$options=array()) {

        $type=isset($options['type'])? $options['type']:'text';


        return $this -> surround('<input type="'.$type.'" name="' . $name . '" value="' . $this -> getValue($name) . '"/>');
    }



    /**
     * @return string
     */
    public function submit($label) {
        return $this -> surround('<button type="submit">'.$label.'</button>');
    }

}
?>