<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//支付宝支付处理1
Route::get('alipay/pay','AlipayController@pay');
//支付宝支付处理2
Route::get('alipay/ipay/{oid?}','AlipayController@ipay');
//异步通知
Route::get('alipay/webNotify','AlipayController@webNotify');
//同步通知
Route::get('alipay/webReturn','AlipayController@webReturn');
//public文件
Route::get('/index','Reception\ReceptionController@index');
//首页
Route::get('/','Reception\ReceptionController@Home');
//分类
Route::get('/id/{id?}','Reception\ReceptionController@select');
//注册
Route::get('/Register','Reception\RegisterController@index');
//加载登录页面
Route::get('/Signin','Reception\SigninController@index');
//处理登录
Route::post('/Signindo','Reception\SigninController@Signindo');
//处理注册
Route::post('/registerdo','Reception\RegisterController@registerdo');
//退出
Route::get('/Signout','Reception\SigninController@Signout');
//购物车
Route::get('/ShoppingCart','Reception\ShoppingCartController@index');
//删除购物车商品
Route::get('/ShoppingCart/delete/{id}','Reception\ShoppingCartController@delete');
//添加购物车
Route::get('/ShoppingCart/getInsert/{id}','Reception\ShoppingCartController@getInsert');
//商品详细
Route::get('goods/{id}','Reception\GoodsController@detailed');
//商品列表
Route::get('/Shoplist/{id?}','Reception\ShoplistController@index');
//立刻购买
Route::get('/immediately/{id?}','Reception\immediatelyController@index');
//确认订单
Route::get('/Order','Reception\OrderController@index');
//购物车购买
Route::get('/myOrder','Reception\OrderController@myOrder');
//立刻购买
Route::get('/Order/{id?}','Reception\OrderController@immediately');
//登录
Route::get('/address','Reception\AddressController@index');
//请登录页面
Route::get('/Pleaselogin','Reception\PleaseloginController@index');
//关于我们路由控制器
Route::get('/aboutus','Reception\AboutUsController@index');
//相关新闻
Route::get('/Relatednews','Reception\RelatednewsController@index');
//个人中心
Route::get('/PersonalCenter','Reception\PersonalCenterController@index');
//修改个人信息
Route::post('/modify','Reception\PersonalCenterController@modify');
//订单管理
Route::get('/Ordercontrol','Reception\PersonalCenterController@ordercontrol');
//个人中心订单列表
Route::get('/Orderlist','Reception\PersonalCenterController@Orderlist');
//处理添加收货地址
Route::post('/doaddress','Reception\AddressController@doaddress');
//地址管理
Route::get('/addresslist','Reception\AddressController@addresslist');
//删除地址
Route::get('/addressdelete/{id}','Reception\AddressController@addressdelete');
//新闻
Route::get('/newslist','Reception\NewslistController@index');
//新闻内容
Route::get('/newscontent/{id?}','Reception\NewslistController@content');
//找回密码
Route::get('/ForgotPassword','Reception\ForgotPasswordController@index');
//查询是否存在用户
Route::post('/doForgotPassword','Reception\ForgotPasswordController@doForgotPassword');
//判断验证码是否正确
Route::post('/DoCode','Reception\ForgotPasswordController@DoCode');
//修改密码
Route::post('/password','Reception\ForgotPasswordController@password');
//Route::get('/')
//查询快递
Route::get('/cx/{name?}/{id?}','Reception\ExpressController@index');
//在线视频
Route::get('/private/{id?}','Reception\PrivateController@index');


//微信
Route::any('/wechat', 'WechatController@serve');
Route::any('/oo', 'WechatController@oo');
Route::any('/oo/{oid?}','WechatController@oo');
Route::any('/ioo','WechatController@ioo');
Route::any('/order-notify','WechatController@notifyUrl');
Route::any('/ok','WechatController@ok');
Auth::routes();


Route::get('/qqlogin','TestController@qqlogin');
Route::get('/qq','TestController@qq');

//预约列表
Route::get('/Subscribelist/{id?}','Reception\SubscribeController@index');
//对象详细
Route::get('/detailed/{id?}','Reception\SubscribeController@detailed');
//处理预约
Route::post('detaileddo','Reception\SubscribeController@detaileddo');
//预约订单
Route::get('bespokeorderlist','Reception\BespokeorderController@index');
//平台注册
Route::get('/platformregister','Reception\platformregisterController@index');
//出来平台注册
Route::post('/platformregisterdo','Reception\platformregisterController@platformregisterdo');
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth']],function ($router)
{
	$router->get('/dash','DashboardController@index')->name('system.index');
	$router->get('/i18n', 'DashboardController@dataTableI18n');

	//导航分类
	$router->get('/classificationlist','ClassificationController@index');
	//用户列表
	$router->get('/homeuser','HomeuserController@index');
	//订单列表
	$router->get('/orderlist','OrderlistController@index');
	//添加用户
	$router->get('/homeuser/create','HomeuserController@create');
	//处理添加用户
	$router->post('/homeuser/createdo','HomeuserController@docreate');
	//查看用户
	$router->get('/homeuser/{id}','HomeuserController@check');
	//初始密码
	$router->get('/homeuser/reset/{id}','HomeuserController@reset');
	//编辑用户
	$router->get('/homeuser/{id}/edit','HomeuserController@edit');
	//处理编辑用户
	$router->post('/homeuser/doedit','HomeuserController@doedit');
	//输出用户
	$router->post('/homeuser/delete/{id}','HomeuserController@delete');
	//添加商品
	$router->get('/addgoods','GoodsController@index');
	//处理添加商品
	$router->post('/doaddgoods','GoodsController@doadd');
	$router->get('/up','HomeuserController@up');
	//商品列表
	$router->get('/goodslist','GoodsController@lst');



	//添加新闻
	$router->get('/addnews','NewsController@add');
	$router->post('/doaddnews','NewsController@doadd');
        //新闻列表
        $router->get('/newslist','NewsController@lists');
        //查看新闻 
        $router->get('/newsedit/{id}','NewsController@edit');
        //修改新闻
        $router->post('/newsupdate','NewsController@update');
        //删除新闻
         $router->get('/newsdel/{id}','NewsController@del');
	// 权限
	require(__DIR__ . '/admin/permission.php');
	// 角色
	require(__DIR__ . '/admin/role.php');
	// 用户
	require(__DIR__ . '/admin/user.php');
	// 菜单
	require(__DIR__ . '/admin/menu.php');

	//require(__DIR__ . '/admin/homeuser.php');
	//require(__DIR__ . '/admin/homeuser.php');

});

// 后台系统日志
Route::group(['prefix' => 'admin/log','middleware' => ['auth','check.permission:log']],function ($router)
{
	$router->get('/','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index')->name('log.dash');
	$router->get('list','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs')->name('log.index');
	$router->post('delete','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete')->name('log.destroy');
	$router->get('/{date}','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@show')->name('log.show');
	$router->get('/{date}/download','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@download')->name('log.download');
	$router->get('/{date}/{level}','\Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel')->name('log.filter');
});
