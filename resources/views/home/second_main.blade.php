<div class="index_per clearfix" >
    <div class="sidebar_per sidebar_first">
        <dl>
            <dt>
                <a href="js.html?/" class="more">更多&nbsp;<span class="more-sign">&gt;</span></a>
                <strong>热点文章 <span class="name-en">/Hot</span></strong>
            </dt>
            @foreach($data as $d)
                <dd class="sidebar_articles">
                    <span>{{ date('m-d',$d->art_time) }}</span>
                    <a target="_blank" href="js.html?/712.html">{{ $d->art_title }}</a>
                </dd>
            @endforeach
        </dl>
    </div>


    <div class="index_recommend" id='index_recommend_0'>
        <div class="head clearfix">
            <strong>站长推荐</strong>
            <a class="more" href="js.html?" target="_blank">更多&nbsp;<span class="more-sign">></span></a>
            <ul class="clearfix index-coupon-menus">
                <li class="current index-coupon-menus-first">
                    全部
                    <span class="arrow-up-menu arrow"></span>
                </li>
                <li>
                    行业 <span class="arrow-up-menu arrow"></span>
                </li>
                <li>
                    商城 <span class="arrow-up-menu arrow"></span>
                </li>
                <li>
                    企业 <span class="arrow-up-menu arrow"></span>
                </li>
                <li>
                    专题 <span class="arrow-up-menu arrow"></span>
                </li>
                <li>
                    后台 <span class="arrow-up-menu arrow"></span>
                </li>
                <li>
                    其他 <span class="arrow-up-menu arrow"></span>
                </li>
            </ul>
        </div>
        <div class="content clearfix">
            <div class="per current">
                <div class="ul_pics">
                    <table style="float: left;margin-left: -20px" >
                        @foreach($hot as $h)
                            <tr>
                                <td>
                                    <img class="" src="uploads\ad651d3eff99db0002be7e555d49c383.jpg" alt="alternative"
                                         style="width: 152px;height: 130px">
                                </td>
                                <td style="text-align: left;" valign="top" width=" ">
                                    <div class="section-title" style="font-size: 16px;color: #00a0e9">
                                        文章名:[{{ $h->art_title }}] 作者:[{{ $h->art_editor }}]
                                        <p >更新时间:[{{ date('Y-m-d'),$h->art_time }}]  浏览次数:[{{ $h->art_view }}] <a href="#">点击收藏</a></p>
                                        <p>简介:{{ $h->art_description }}</p>
                                    </div>
                                    <a class="btn-solid-reg page-scroll" href="{{ url('a/'.$d->art_id) }}">点击阅读</a><hr>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>