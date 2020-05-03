<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //关联数据表
    protected $table = 'permission';
    //主键
    protected  $primaryKey = 'id';
    //是否允许批量上传
//    protected $fillable = ['user_name','user_pass','email','phone'];
    //没有不允许的批量上传 ，等同上面
    protected $guarded = [];
    //时间维护
    public $timestamps = false;


}
