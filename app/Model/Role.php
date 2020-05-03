<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //关联数据表
    protected $table = 'role';
    //主键
    protected  $primaryKey = 'id';
    //是否允许批量上传
//    protected $fillable = ['user_name','user_pass','email','phone'];
    //没有不允许的批量上传 ，等同上面
    protected $guarded = [];
    //时间维护
    public $timestamps = false;

    //添加动态属性，关联权限模型
    public function permission(){
        //多对多模型 belongsToMany,模型，被关联表名，当前关联表id，被关联表id
        return $this->belongsToMany('App\Model\Permission','role_permission','role_id','permission_id');
    }
}
