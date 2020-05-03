<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use App\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class ArticleController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $arts = Article::all();
        return view('admin.article.list',compact('arts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cate = (new Cate())->tree();
//        dd($cate);
        return view('admin.article.add',compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $article = $request->except('_token');
        $res = Article::create($article);
        return parent::senMsg($res, 'admin/article');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $cates = (new Cate)->tree();
        $arts = Article::find($id);
        return view('admin.article.edit',compact('arts','cates'));
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
        $input = $request->except('artid','_token','phote');
//        dd($input);
//        使用模型修改表记录的两种方法,方法一
        $art = Article::find($id);
        $res = $art->update($input);

        if($res){
            $data = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
//            return 2222;
            $data = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
        return $data;
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
    public function upload(Request $request){
//        // open an image file
//        $img = Image::make('public/foo.jpg');
//
//// resize image instance
//        $img->resize(320, 240);
//
//// insert a watermark
//        $img->insert('public/watermark.png');
//
//// save image in desired format
//        $img->save('public/bar.jpg');

        //获取上传文件
        $file =  $request->file('photo');
        //判断是否接收成功
        if(!$file->isValid()){
              return response()->json(['ServerNo'=>400,'ResultData'=>'无效文件！']);
        }
        //获取源文件的扩展名
        $ext = $file->getClientOriginalExtension();
        //生成新的文件名
        $newFile = md5(time().rand(1000,9999)).'.'.$ext;
        //将文件移动到指定目录
        $path = public_path('uploads');
        //将文件从临时目录移动到本地指定目录,判断是否接收成功
//        if(! $file->move($path,$newFile)){
//            return response()->json(['ServerNo'=>'400','ResultData'=>'保存文件失败']);
//        }
//        return response()->json(['ServerNo'=>'200','ResultData'=>$newFile]);
        //最好放在云存储里面，后续改善
        $res = Image::make($file)->resize(250,100)->save($path.'/'.$newFile);
        if(!$res){
            return response()->json(['ServerNo'=>400,'ResultData'=>'无效文件！']);
        }
       return response()->json(['ServerNo'=>200,'ResultData'=>'上传成功！','path'=>$newFile]);

    }
}

