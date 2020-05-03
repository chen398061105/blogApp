<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //关联数据表
    protected $table = 'category';
    //主键
    protected $primaryKey = 'cate_id';
    //是否允许批量上传
//    protected $fillable = ['user_name','user_pass','email','phone'];
    //没有不允许的批量上传 ，等同上面
    protected $guarded = [];
    //时间维护
    public $timestamps = false;

    //获取格式化分类数据
    public function tree($id = null)
    {
        //获取所有分类的数据
        $catesQuery = $this->orderBy('cate_order', 'asc');
        if (!empty($id)) {
            $catesQuery->whereIn('cate_id', $id);
        }
        $cates = $catesQuery->get();
        //格式化 排序，二级分类
        return $this->getTree($cates);


    }

    public function getTree($category)
    {
        //先获取到一级父类  $data[$key]['_'.$name] =$data[$key][$name];
        $arr = [];//存放最终排完序的数据
        foreach ($category as $key => $value) {
            if ($value->cate_pid == 0) {
                $category[$key]['_cate_name'] = $category[$key]['cate_name'];
                $arr[] = $value;
                //在一级类里面排二级类
                foreach ($category as $m => $n) {
                    if ($value->cate_id == $n->cate_pid) {
                        $n->cate_name = '|---' . $n->cate_name;
                        $arr[] = $n;
                    }
                }
            }
        }
        return $arr;
    }

    //定义跟文章表的关联属性
    public function article()
    {
        //第二参数 预关联的 外键，第三参数 当前表的主键
        return $this->hasMany('App\Model\Article','cate_id','cate_id');
    }
}
