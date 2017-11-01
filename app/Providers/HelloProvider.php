<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Validator;
use App\Http\Validators\HelloValidator;

// 作成したバリデータを組み込むにはサービスプロバイダを利用。
class HelloProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $validator = $this->app['validator'];
        $validator->resolver(function($translator, $data, $rules, $messages){
            return new HelloValidator($translator, $data, $rules, $messages);
        });
        // View::composer(
        //     'hello.index','App\Http\Composers\HelloComposer'
        // );
        // View::composer(ビューの指定、関数またはクラス);第一引数にはビューが第二引数には実行する処理となるクロージャーかビューコンポーザーのクラスを指定する。
        // $view->with(変数名、値);ビューに変数などを追加するためのもの。
        // $view->with('view_message', 'composer message!');
        // config/app.phpにサービスプロバイダを登録しにいく


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
