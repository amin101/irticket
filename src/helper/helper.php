<?php

/*
 * add error class for bootstrap form
 */
function addErrorClass($errors, $error_name) {
    if($errors->has($error_name)){
        return ' has-error';
    }
}

/*
 * return error message for bootstrap form
 */
function InputErrorMessage($errors,$error_name) {
    if($errors->has($error_name))
        return '<span class="help-block">'.$errors->first($error_name).'</span>';
}


