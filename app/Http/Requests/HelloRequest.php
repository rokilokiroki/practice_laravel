<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HelloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == '/') {
            return true;
        } else {
            return false;
        }
    }
        // $this->pathでアクセスしたパスをチェックしている。パスが指定のものだったらtrueをそうでなければfalseを指定している。
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name'=>'required',
          'mail'=>'email',
          'age'=>'numeric|hello',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => '名前は必ず入力して',
            'mail.email' => 'メールアドレスが必要です',
            'age.numeric' => '年数は整数で記入して下さい',
            'age.hello' => '入力項目は偶数のみ',
        ];
    }
}
