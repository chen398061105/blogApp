<div id='nav' class='nav' style="background-color: #423b34">
    <div class='nav_main clearfix'>
        <a href='http://www.erdangjiade.com' class="menu current">首 页</a>
        @foreach($banner as $b)
        <a href='{{ $b->cate_id }}' class="menu">{{ $b->cate_name }}</a>
        @endforeach
        <span class='icon_hot'></span>
    </div>
</div>