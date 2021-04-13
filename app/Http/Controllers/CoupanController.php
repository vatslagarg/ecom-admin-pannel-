<?php

namespace App\Http\Controllers;

use App\Models\Coupan;
use Illuminate\Http\Request;

class CoupanController extends Controller
{
    public function index()
    {
        $result['data']=Coupan::all();
        return view('admin/coupan',$result);
    }

    
    public function manage_coupan(Request $request,$id='')
    {
        if($id>0)
        {
            $arr=Coupan::where(['id'=>$id])->get(); 
            $result['title']=$arr['0']->title;
            $result['code']=$arr['0']->code;
            $result['value']=$arr['0']->value;
            $result['id']=$arr['0']->id;
        }

        else{
            $result['title']='';
            $result['code']='';
            $result['value']='';
            $result['id']=0;
        }
        return view('admin/manage_coupan',$result);
    }

    public function manage_coupan_process(Request $request)
    {
       // return $request->post();
       $request->validate([
           'title'=>'required',
           'code'=>'required|unique:coupans,code,'.$request->post('id'),
           'value'=>'required',
        ]);

       
        if($request->post('id')>0)
        {
            $model=Coupan::find($request->post('id'));
            $msg="Coupan updated";
        }
        else{
            $model=new Coupan();
            $msg="Coupan inserted";
        }
        $model->title=$request->post('title');
        $model->code=$request->post('code');
        $model->value=$request->post('value');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/coupan');

    }

    public function delete(Request $request,$id)
    {
        $model=Coupan::find($id);
        $model->delete();
        $request->session()->flash('message','Coupan deleted');
        return redirect('admin/coupan');
    }

    public function status(Request $request,$status,$id)
    {
        $model=Coupan::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Coupan status updated');
        return redirect('admin/coupan');
    }
}
