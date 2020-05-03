<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends  Model
{ 
    //关联数据表
    protected $table = 'user';
    //主键
    protected  $primaryKey = 'user_id';
    //是否允许批量上传
//    protected $fillable = ['user_name','user_pass','email','phone'];
    //没有不允许的批量上传 ，等同上面
    protected $guarded = [];
    //时间维护
    public $timestamps = false;
    //关联角色模型
    public function role(){
            //两表的名字拼凑，两表的id
        return $this->belongsToMany('App\Model\Role','user_role','user_id','role_id');
    }
}
