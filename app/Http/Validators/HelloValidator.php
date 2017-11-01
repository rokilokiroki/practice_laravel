<?php
namespace App\Http\Validators;
use Illuminate\Validation\Validator;

/**
*
*/
class HelloValidator extends Validator
{

  public function validateHello($attribute, $value, $parameters)
  {
    // validateHelloというメソッドを定義すれば,helloというルールが生まれる。今、helloという新しいvalidateruleが生まれた。
    return $value % 2 == 0;
  }

}


?>
