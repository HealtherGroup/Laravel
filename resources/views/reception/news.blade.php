@extends('reception.public.public')
@section('title','相关新闻')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('reception/src/css/newsList.css') }}"/>
@endsection
@section('content')
	<div class="width-auto miaobaoxie">
		<ol class="area">
  			<li><a href="/">首页</a></li>
  			<li>></li>
  			<li class="color-green"><a href="#" onClick="javascript:history.back(-1);">上一页</a></li>
		</ol>
	</div>
<div class="width-auto bgc-b1 news-list-box">
    <div class="news-list-warp clearfix">
        <div class="news-list-item-warp">
        @foreach($newslist as $news)
            <a href="{{ asset('/newscontent') }}/{{ $news->id }}">
                <div class="news-list-item clearfix">
                    <div class="newslist-item-left">
                        <img src="{{ $news->img }}" alt="">
                    </div>
                    <h2>{{ $news->title }}</h2>
                    <p class="newslist-item-txt">{{ $news->desc }}</p>
                    <span>{{ $news->time }}</span>
                </div>
            </a>
        @endforeach
        </div>
                        <div class="box-footer clearfix">

               <div style="float:right"> {!! $newslist->render() !!}</div>
                </div>
    </div>
</div>
@endsection
