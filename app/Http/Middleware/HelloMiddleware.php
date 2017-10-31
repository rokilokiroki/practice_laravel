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
        $response = $next($request);
        $content = $response->content();
        $pattern = '/<middleware>(.*)<\/middleware>/i';
        $replace = '<a href="http://$1">$1</a>';
        $content = preg_replace($pattern, $replace, $content);
        $response->setContent($content);
        return $response;
        // $request->merge(['data'=>$data]);
        // $request->merge(配列);
        // このmergeはフォームの送信などで送られる値（inputの値）に新たな値を追加するもの。
        // これにより、dataという項目で$dataの内容が追加される。コントローラー側では$request->dataでこの値を取り出せる。
        // 作成されたmiddlewareはweb.phpにてルート処理を行う。
    }
}
