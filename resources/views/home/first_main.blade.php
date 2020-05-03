
<div class="index_per index_first clearfix">
    <div class="sidebar_per sidebar_first">
        <dl>
            <dt>
                <a href="js.html?/" class="more">更多&nbsp;<span class="more-sign">&gt;</span></a>
                <strong>最新更新 <span class="name-en">/New</span></strong>
            </dt>
            @foreach($news as $n )
            <dd class="sidebar_articles">
                <span>{{ date('m-d'),$n->art_time }}</span>
                <a target="_blank" href="js.html?/712.html">{{ $n->art_title }}</a>
            </dd>
            @endforeach
        </dl>
    </div>
    <div class="index_left clearfix">
        <div class="banner" id="banner">
            <ul id="index_banner">
                <li>
                    <a target="_blank" href="js.html?/0-0-52-0-0-0">
                        <img alt="响应式模板" src="home/images/other/mobile.jpg">
                    </a>
                </li>
                <li>
                    <a target="_blank" href="js.html?/22-0-0-0-0-0">
                        <img alt="商城,特卖模板" src="home/images/other/mall.jpg">
                    </a>
                </li>
                <li>
                    <a target="_blank" href="js.html?/53-0-0-0-0-0">
                        <img alt="404模板" src="home/images/other/404.jpg">
                    </a>
                </li>
            </ul>
            <div class="banner_page" id="banner_page"></div>
            <a class="banner_page_btn banner_page_left" id="banner_page_left"></a>
            <a class="banner_page_btn banner_page_right" id="banner_page_right"></a>
        </div>
        <div class='merchant_cats'>
            <div class='head'><h3>网站快速导航</h3></div>
            <div class="content" id="merchant_cats_menus">
                <a href="js.html?"><i class="merchant_arrow merchant_arrow_right"></i><span
                            class="icon_merchant icon_merchant_fire"></span><span class="name">网站模板</span><i
                            class="merchant_arrow_left"></i> </a>
                <a href="js.html?/0-0-52-0-0-0"><i class="merchant_arrow merchant_arrow_right"></i><span
                            class="icon_merchant icon_merchant_mobile"></span><span class="name">手机模板</span><i
                            class="merchant_arrow_left"></i></a>
                <a href="js.html?"><i class="merchant_arrow merchant_arrow_right"></i><span
                            class="icon_merchant icon_merchant_js"></span><span class="name">网页特效</span><i
                            class="merchant_arrow_left"></i></a>
                <a href="js.html?"><i class="merchant_arrow merchant_arrow_right"></i><span
                            class="icon_merchant icon_merchant_png"></span><span class="name">PHP</span><i
                            class="merchant_arrow_left"></i></a>
                <a href="js.html?"><i class="merchant_arrow merchant_arrow_right"></i><span
                            class="icon_merchant icon_merchant_typeface"></span><span class="name">精品网址</span><i
                            class="merchant_arrow_left"></i></a>
                <a href="js.html?/124-0-0-0"><i class="merchant_arrow merchant_arrow_right"></i><span
                            class="icon_merchant icon_merchant_code"></span><span class="name">Ajax</span><i
                            class="merchant_arrow_left"></i></a>
            </div>
        </div>
    </div>
</div>

