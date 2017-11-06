<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restdata extends Model
{
    protected $table = 'restdata';
    // クラスの最初に$tableというメンバ変数を定義している。これはテーブル名を指定するためのもの。
    protected $guarded = array('id');

    public static $rules = array(
      'message' => 'required',
      'url' => 'required',
    );

    public function getData()
    {
      return $this->id. ':'.$this->message. '('.$this->url .')';
    }
}
