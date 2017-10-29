<?php

namespace App\Http\Middleware;

use Closure;

class HelloMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    $data =[
      ['name'=>'山田', 'mail'=>'taro@yamada'],
      ['name'=>'山元', 'mail'=>'ziro@yamamoto'],
      ['name'=>'山義', 'mail'=>'saburo@yamagi'],
    ];
        $request->merge(['data'=>$data]);
        // $request->merge(配列);
        // このmergeはフォームの送信などで送られる値（inputの値）に新たな値を追加するもの。
        // これにより、dataという項目で$dataの内容が追加される。コントローラー側では$request->dataでこの値を取り出せる。
        // 作成されたmiddlewareはweb.phpにてルート処理を行う。
        return $next($request);
    }
}
