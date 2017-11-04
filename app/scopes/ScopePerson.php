<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class ScopePerson implements Scope
{
  public function apply(Builder $builder, Model $model)
  {
    $builder->where('age', '>', 20);
    // 複数のモデルや、その他のプロジェクトなどでも利用されるような汎用性の高い処理はScopeクラスとして作成しておくと便利。
    // Scopeクラスでは、applyメソッドを一つ用意する。このメソッドでは、BuilderとModelがインスタンスとして渡される。これらの引数を用いて、絞り込みの処理を行う
  }
}

