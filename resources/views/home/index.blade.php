@extends('layouts.home')
@section('main_content')
    <!-- Intro  main-->
    <div id="intro" class="container">
        {{--    第一阶层内容 开始--}}
        @include('home.first_main')
        {{--    第一阶层内容 结束--}}
        {{--    第二阶层内容 开始--}}
        @include('home.second_main')
        {{--    第二阶层内容 结束--}}
    </div>
    <!-- end of intro main-->
@endsection