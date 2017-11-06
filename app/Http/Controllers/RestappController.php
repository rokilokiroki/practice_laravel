<?php
// php artisan make:controller RestappController --resource
//  --resourceというオプションを追記したおかげでリソースとしてコントローラーにメソッド類を追記しておくためのもの。
// railsと同じような事が出来る。

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restdata;

class RestappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Restdata::all();
        return $items->toArray();
        // toArrayメソッドはコレクションをPHPの「配列」へ変換します。コレクションの値がEloquentモデルの場合は、そのモデルが配列に変換されます。
        // 実はLaravelではアクションメソッドで配列をreturnすると、自動的にその配列データをJSON形式に変換して出力してくれるようになっている。JSON形式であれば、外部のサーバーからアクセスして取得したデータを簡単に処理することができる。

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restdata = new Restdata;
        $form = $request->all();
        unset($form['_token']);
        $restdata->fill($form)->save();
        return redirect('/rest');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Restdata::find($id);
        return $items->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
