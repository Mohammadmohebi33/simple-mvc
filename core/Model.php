<?php

namespace app\core;

abstract class Model
{
    public array $errors = [] ;

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min' ;
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';



    public function loadData($data)
    {
        foreach ($data as $key => $value){
            if (property_exists($this , $key)){
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rule():array;


    public function validate()
    {
       foreach ($this->rule() as $attribute => $rules){
          $value = $this->{$attribute};
          foreach ($rules as $rule){
              if (!is_string($rule)){
                  $ruleName = $rule[0];
              }
              if ($rule === self::RULE_REQUIRED && !$value){
                  $this->addError($attribute , self::RULE_REQUIRED);
              }
          }
       }
       return empty($this->errors);
    }



    public function addError($attribute , $rule)
    {
        $message = $this->errorMessage()[$rule];
        $this->errors[$attribute][] = $message;
    }

    public function errorMessage()
    {
        return[
            self::RULE_REQUIRED => 'This field is required',
        ];
    }
}
