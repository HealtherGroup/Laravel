<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service\Admin\RoleService;
use App\Http\Requests\RoleRequest;
class NewsController extends Controller
{
    public function add()
    {
        return view('admin.news.add');
    }
    public function doadd(Request $request)
    {
        $name = $request->input('name');
        $intro = $request->input('intro');
        $content = $request->input('content');
        $file = $request->file('file');
        $allowed_extensions = ["png", "jpg", "gif"];
        $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = '/'.$destinationPath.''.str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        //dd($content);
        $time = date("Y-m-d H:i");
        //dd($time);
        $data = \DB::table('news')->insert(array('title' => $name,'content' => $content,'time' => $time,'desc' => $intro,'img' => $fileName));
        if($data){
            return redirect('/admin/newslist');
        }else{
            return back();
        }
    }
    /**
     *2016年12月30日15:57:05
     * 
     *
     */
    public function lists()
    {
        $data = \DB::table('news')->get();
         //dd($data);
        return view('admin.news.list',['data' => $data]);
    }
    
    public function edit($id)
    {
        $data = \DB::table('news')->where('id',$id)->first();
        //dd($data);
        return view('admin.news.edit',['data'=>$data]);
    }
    
    public function update(Request $request)
    {
        $id=$request->input('id');
        $data = $request->except('_token','id');
        //dd($data);
        $img=$request->file('img');
        //dd($img);
       
        //die;
        if(!empty($request -> input('img'))){
        $res = \DB::table('news') -> where('id',$id) -> first();
            if(unlink('$res->img')){
                $file = $request->file('img');
                $allowed_extensions = ["png", "jpg", "gif"];
                $destinationPath = 'uploads/images/';
                $extension = $file->getClientOriginalExtension();
                $fileName = '/'.$destinationPath.''.str_random(10).'.'.$extension;
                $file->move($destinationPath, $fileName);
             }else{
                 return '图片上传失败';
             }
            $row = \DB::table('news') -> where('id',$id) -> update($data);
                    if($row){
                        return redirect('/admin/newslist');
                    }else{
                        return 0;
                    }
            }else{
            return '修改失败';
        }
       
    }
    
    public function del($id)
    {
        //return $id;
        $row = \DB::table('news') -> where('id',$id) -> delete();
        if($row){
            return redirect('/admin/newslist');
        }else{
            return 0;
        }
    }
}
