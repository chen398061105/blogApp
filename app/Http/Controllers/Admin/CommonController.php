<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //前台直接删除
    public function senMsg($res=false)
    {
        if ($res) {
            $data = [
                'status' => 0,
                'message' => '操作成功！'
            ];
        } else {
            $data = [
                'status' => 1,
                'message' => '操作失败！'
            ];
        }
        return $data;
    }
    //后台直接调用flash方法删除
    public function senFlashMsg($res=false,$url){
        if ($res) {
            flash('操作成功！')->overlay();
            return redirect($url);
        } else {
            flash('操作失败!')->overlay();
            return redirect()->back();
        }
    }

}
