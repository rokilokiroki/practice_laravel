<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
      'person_id' => 'required',
      'title' => 'required',
      'message' => 'required'
    );

    public function person()
    {
      return $this->belongsTo('App\Person');
    }
    // belongsToは従テーブル側から、関連付けている主テーブルのレコードを取り出すためのもの。

    public function getData()
    {
      return $this->id. ':'.$this->title.'('.$this->person->name.')';
    }

}
