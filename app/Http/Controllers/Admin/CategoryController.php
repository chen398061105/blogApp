<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Cate;
use Illuminate\Http\Request;

class CategoryController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cates = Cate::query()->orderBy('cate_id', 'desc')
            ->where(function ($query) use ($request) {
                $catename = $request->get('catename');
                if (!empty($catename)) {
                    $query->where('cate_name', 'like', '%' . $catename . '%');
                }
            })->paginate($request->input('num') ? $request->input('num') : 5);

        $ids = $cates->pluck('cate_id')->toArray();
        $pids = $cates->pluck('cate_pid')->toArray();
        $merger_ids = array_merge($ids, $pids);

        $cate = (new Cate())->tree($merger_ids);

        return view('admin.category.list', compact('cate', 'cates', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取一级类
        $cate = Cate::where('cate_pid', 0)->get();

        return view('admin.category.add', compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->except('_token');
        //表单验证。。暂时不做
        // insert into db
        $res = Cate::create($input);
        return parent::senMsg($res, 'admin/category');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cate = Cate::findOrFail($id);
        return view('admin.category.edit', compact('cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $cate = Cate::find($id);
        $input = $request->all();
        $res = $cate->update($input);
        return parent::senMsg($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $input = Cate::find($id)->delete();
        return parent::senMsg($input);
    }

    public function changeOrder(Request $request)
    {
//        1. 获取传过来的参数
        $input = $request->except('_token');
        //2. 通过分类id获取当前分类
        $cate = Cate::find($input['cate_id']);
        //3. 修改当前分类的排序值
        $res = $cate->update(['cate_order' => $input['cate_order']]);

        return parent::senMsg($res);
    }

    public function delAll(Request $request)
    {
        $input = $request->get('ids');
        $destroy = Cate::destroy($input);
        return parent::senFlashMsg($destroy, 'admin/category');
    }


}
