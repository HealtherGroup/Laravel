@extends('layouts.admin')
@section('css')
<link href="{{asset('vendors/dataTables/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>订单列表</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin/dash')}}">{!!trans('admin/breadcrumb.home')!!}</a>
        </li>
        <li class="active">
            <strong>订单列表</strong>
        </li>
    </ol>
  </div>
  @permission(config('admin.permissions.user.create'))
  <div class="col-lg-2">

  </div>
  @endpermission
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>订单列表</h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content">
          @include('flash::message')
          <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTablesAjax" >
                  <thead>
                      <tr style="text-align:center;">
                                    <th>下单时间</th>
                                    <th>状态</th>
                                    <th>用户名</th>
                        <th>订单号</th>
                                    <th>商品数量</th>
                                    <th>总价</th>
                        <th width="120px">操作</th>
                      </tr>
                  </thead>
                  <tbody>


              @foreach($list as $data)

              <tr style="height:100px; line-height:100px;">
                    <td>{{ $data->create_time }}</td>
                    <td>
                    @if($data->state =='1')
                        <span style="color:red">未付款</span>
                    @else($data->state=='2')
                        @if($data->kid== null)
                          <span style="color:green">已付款</span><span style="color:red;">未发货</span>
                        @else
                            <span style="color:green">已付款 已发货 </span>
                        @endif
                    @endif</td>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->oid }}</td>
                    <td>{{ $data->ordernum}}</td>
                    <td>{{ $data->tatal }}</td>
                   <td>
                        <a href="/admin/orderlist/detail/{{ $data->oid}}/">查看详情</a>
                   </td>
              </tr>

              @endforeach

                  </tbody>
              </table>

 <div style="float:right"> {!! $list->render() !!}</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{asset('vendors/dataTables/datatables.min.js')}}"></script>
<script src="{{asset('vendors/layer/layer.js')}}"></script>
<script type="text/javascript">
  $(document).on('click','.destroy_item',function() {
    var _item = $(this);
    layer.confirm('{{trans('admin/alert.deleteTitle')}}', {
      btn: ['{{trans('admin/action.actionButton.destroy')}}', '{{trans('admin/action.actionButton.no')}}'],
      icon: 5,
    },function(index){
      _item.children('form').submit();
      layer.close(index);
    });
  });
  $(document).on('click','.reset_password',function() {
    var item = $(this);
    layer.confirm('{{trans('admin/alert.reset_password').config('admin.global.reset')}}', {
      btn: ['{{trans('admin/action.actionButton.reset')}}','{{trans('admin/action.actionButton.no')}}'] //按钮
    }, function(){
      var _id = item.attr('data-id');
      $.ajax({
        url:'/admin/homeuser/reset/'+_id+'',
        success:function (response) {
          layer.msg('成功');
          layer.close(index);
        }
      });
    });
  });
</script>
@endsection
