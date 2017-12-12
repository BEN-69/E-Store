<?php

namespace MVC\Lib\Html;


class BootstrapForm extends Form {
        
   
    public function surround($html) {

        return "<div class=\"form-group\">{$html}</div>";
    }

    /**
     * @param $name
     * @param $label
     * @param array $options
     * @return string
     */
    public function input($name,$label,$options=array()) {

        $type= isset($options['type'])? $options['type']:'text';

        $label='<label class="control-label">'.$label.'</label>';

        if($type=='textarea'){

            $input='<textarea id="message" required="required" class="form-control" value="votre message" rows="8" name="'.$name.'">'.$this->getValue($name).'
                </textarea>';

        }else{

            $input='<div class="controls">';
            $input.='<input type="'.$type.'" class ="form-control" id="' . $name . '" name="' . $name . '" required="required" value="' . $this->getValue($name).'"/>' ;
            $input.='</div>';
        }


        return $this -> surround(
            $label.$input
        );
    }


    public function select($name,$label,$options) {


        $label='<label for="sel1" class="control-label">'.$label.'</label>';

        $input='<div class="col-sm-5"><select class ="form-control" name="' . $name . '"/>';



        foreach($options as $k => $v){

            $attributes='';

            if($k == $this -> getValue($name)){
                $attributes=' selected';
            }

            $input.= '<option value="'.$k.'" '.$attributes.'="'.$k.'">' . $v . '</option>';
        }


        $input.='</select></div>';


        return $this -> surround($label.$input );
    }


     public function submit($label) {
        return

        '<button type="submit" name="submit" class="btn btn-primary" value="save" required="required">'.$label.'</button>'

        ;
    }

    public function reset($label) {
        return '<button type="reset" name="reset" class="btn" value="reset">'.$label.'</button>';

    }
}
?>