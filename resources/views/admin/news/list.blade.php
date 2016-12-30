@extends('layouts.admin')
@section('css')
<link href="{{asset('vendors/dataTables/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>新闻列表</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin/dash')}}">{!!trans('admin/breadcrumb.home')!!}</a>
        </li>
        <li class="active">
            <strong>新闻列表</strong>
        </li>
    </ol>
  </div>
  @permission(config('admin.permissions.user.create'))
  <div class="col-lg-2">
    <div class="title-action">
      <a href="{{url('admin/addnews')}}" class="btn btn-info">添加新闻</a>
    </div>
  </div>
  @endpermission
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>新闻列表</h5>
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
			            <th>新闻标题</th>
			           
			            <th width="240px">操作</th>
			          </tr>
		          </thead>
		          <tbody>
              @foreach($data as $data)
              <tr style="height:50px; line-height:100px;">
                    
                    <td>{{ $data->title }}</td>
                 
                    <td >
                        <a href="/newscontent/{{ $data->id }}">查看</a>&nbsp&nbsp&nbsp
                        |&nbsp&nbsp&nbsp<a href="/admin/newsedit/{{ $data->id }}">编辑</a>&nbsp&nbsp&nbsp
                        |&nbsp&nbsp&nbsp<a href="/admin/newsdel/{{ $data->id }}">删除</a>&nbsp&nbsp&nbsp
                    </td>
              </tr>
              @endforeach
		          </tbody>
	          </table>

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
