<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="会员管理">&#xe6b8;</i>
                    <cite>会员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('会员列表','{{ url('admin/user') }}'),true">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('会员添加','{{ url('admin/user/create') }}'),true">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员添加</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="会员管理">&#xe6b8;</i>
                    <cite>角色管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('角色列表','{{ url('admin/role') }}'),true">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>角色列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('角色添加','{{ url('admin/role/create') }}'),true">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>角色添加</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="权限管理">&#xe6b8;</i>
                    <cite>权限管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('权限列表','{{ url('admin/permission') }}'),true">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('权限添加','{{ url('admin/permission/create') }}'),true">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限添加</cite></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="分类管理">&#xe723;</i>
                    <cite>分类管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('分类列表','{{ url('admin/category') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>分类列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('添加分类','{{ url('admin/category/create') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加分类</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="文章管理">&#xe723;</i>
                    <cite>文章管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('文章列表','{{ url('admin/article') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>文章列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('添加文章','{{ url('admin/article/create') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加文章</cite></a>
                    </li>
                </ul>
            </li>
           
           
          
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
