<div id="header">
    <div class="tg_tools_home">
        <div class="bbs_enter">
            <a class="bbs-banner" href="help.html" target="_blank"><img src="home/images/other/banner.jpg" alt="扒模板"/></a>
        </div>
        <div id ="logo" class="logo">
            <a class="logo-bd" href="index.html"><img src="home/images/logo.png" alt="二当家的logo"/></a>
        </div>
        <form action="search.html" method="GET" id="form_search" onsubmit="return searchSub()">
            <div id='search'>
                <div class="search_area">
                    <input type='submit' value='搜 索' class='btn_search'/>
                    <div class="search_select">
                        <span class="icon-search"></span>
                    </div>
                    <input type='text' value='请输入搜索内容' class="search_input" autocomplete="off" id="search_input"
                           data-default="请输入搜索内容" onblur="checkInputBlur($(this))" onfocus="checkInputFocus($(this))"/>
                    <input type="hidden" name="keyword"/>
                </div>
                <div class="search_box hide" id="search_box"></div>
            </div>
        </form>
    </div>
</div>