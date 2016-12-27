@extends('reception.public.public')
@section('title','商品列表')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('reception/css/Accountinformation.css') }}">
@endsection
@section('content')
  <div class="Account-body width-auto">
    <div class="Account-body-header width-auto text-center">
      <img src="{{ asset('reception/images/yuanguoqi.png') }}" alt="">
      <p class="">昵称：{{ session('username') }}</p>
    </div>
    <div class="Account-body-nav area container">
      <ul class="row">
        <li class="col-lg-1 col-md-1"></li>
        <li class="col-lg-2 col-md-2"><a href="{{ asset('/PersonalCenter') }}">账户信息</a></li>
        <li class="col-lg-2 col-md-2"><a href="{{ asset('/Orderlist') }}">我的订单</a>
          <div class="Account-body-nav-div1"></div>
        </li>
        <li class="col-lg-2 col-md-2"><a href="{{ asset('/bespokeorderlist') }}">预约订单</a></li>
        <li class="col-lg-2 col-md-2"><a href="{{ asset('/address') }}">地址管理</a></li>
        <li class="col-lg-1 col-md-1"></li>
      </ul>
    </div>
    <div class="Account-body-subnav area">
      <div class="Account-order-nav width-auto overflow-h">
        <span class="float-left text-left">待付款</span>
        <span class="float-left">待收货</span>
        <span class="float-left">待评价</span>
        <span class="float-left">退款</span>
        <span class="float-right zwq-active">全部订单</span>
      </div>
    </div>
    <table class="Account-body-main area">
      <thead>
        <tr class="border-bottom-10-CCC">
          <th>订单详情</th>
          <th>单价(元)</th>
          <th>数量</th>
          <th>小计(元)</th>
          <th>交易状态</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
       @foreach($list as $list)
        <tr>
          <td class="padding-10"><b>下单时间：{{ $list->create_time }}　　订单号：{{ $list->oid }}</b></td>
        </tr>
      @foreach($orderdata as $orderdata1)
      @if( $orderdata1->oid == $list->oid )
        <tr>
          <td>
            <a class="float-left padding-left-20" href="{{ asset('/goods') }}/{{ $orderdata1->gid }}"><img style="width:100px;height:100px" class="img-responsive" src="{{ $orderdata1->img }}" alt=""></a>
            <div class="float-left">
              <p class="margin-left-10px margin-bottom-8" style="line-height:100PX;">{{ $orderdata1->gname }}</p>
            </div>
          </td>
          <td class="text-center">
            ￥ {{ $orderdata1->price }}
          </td>
          <td class="text-center">
            {{ $orderdata1->num }}
          </td>
          <td class="text-center">
            ￥{{ $orderdata1->price * $orderdata1->num }}
          </td>
          <td class="text-center">
            @if( $list->state == 2)
              已付款
            @elseif($list->state == 1)
              未付款
            @endif
        </tr>
      @endif
      @endforeach

        <tr class="border-bottom-1-s-C">
          <td>
            @if( $list->state == 2)
              <a href="{{ asset('/cx') }}/{{ $list->kname }}/{{ $list->kid }}" class="Account-body-main-See text-center show" >查看物流</a>
            @elseif($list->state == 1)
              <a href="{{ asset('/alipay/ipay') }}/{{ $list->oid }}" class="Account-body-main-See text-center show" href="###">付款</a>
            @endif

          </td>
        </tr>
     @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
  </div>
  <div class="Account-body-main-See-div margin-left-10px">
    <div class="padding-20 Account-body-main-See-div-1">
      <span><b>物流编号：</b></span>
      <span class="close zwq-close">关闭</span>
      <p><b>LP00027121r124112424(顺风快递)</b></p>
      <p>物流信息：</p>
      <p>2016-9-20 16:42 <span>卖家已发货</span></p>
    </div>
    <div class="padding-20 Account-body-main-See-div-2">
      <span class="close zwq-close">关闭</span>
      <form action="">
        <textarea name="" id="" cols="30" rows="10">

        </textarea>
      </form>
    </div>
    <div class="padding-20 Account-body-main-See-div-3">
      <span class="close zwq-close">关闭</span>
      <form action="">
        <textarea name="" id="" cols="30" rows="10">
          1111
        </textarea>
      </form>
    </div>
  </div>
  <script type="text/javascript" src="./js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
    function kd(name,id){
          $('.Account-body-main-See-div').css('display','block');
    $('.Account-body-main-See-div-2').css('display','none')
    $('.Account-body-main-See-div-3').css('display','none')
    $('.Account-body-main-See-div-1').css('display','block');
    event.stopPropagation();
      $('.Account-body-main-See-div>div').click(function(event){
        $('.Account-body-main-See-div').css('display','block');
        event.stopPropagation();
      })
    }

// 关闭查看物流
$(document).click(function(event){
   $('.Account-body-main-See-div').css('display','none');
   event.stopPropagation();
})
$('.zwq-close').click(function(event){
   $('.Account-body-main-See-div').css('display','none');
   event.stopPropagation();

})

  </script>
  <script type="text/javascript" src="./js/Account information.js"></script>

@endsection
