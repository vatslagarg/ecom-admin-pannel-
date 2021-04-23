<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupan;
use Illuminate\Http\Request;

class CoupanController extends Controller
{
    public function index()
    {
        $result['data'] = Coupan::all();
        return view('admin/coupan', $result);
    }


    public function manage_coupan(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Coupan::where(['id' => $id])->get();
            $result['title'] = $arr['0']->title;
            $result['code'] = $arr['0']->code;
            $result['value'] = $arr['0']->value;
            $result['type'] = $arr['0']->type;
            $result['min_order_amt'] = $arr['0']->min_order_amt;
            $result['is_one_time'] = $arr['0']->is_one_time;
            $result['id'] = $arr['0']->id;
        } else {
            $result['title'] = '';
            $result['code'] = '';
            $result['value'] = '';
            $result['type'] = '';
            $result['min_order_amt'] = '';
            $result['is_one_time'] = '';
            $result['id'] = 0;
        }
        return view('admin/manage_coupan', $result);
    }

    public function manage_coupan_process(Request $request)
    {
        // return $request->post();
        $request->validate([
            'title' => 'required',
            'code' => 'required|unique:coupans,code,' . $request->post('id'),
            'value' => 'required',
        ]);


        if ($request->post('id') > 0) {
            $model = Coupan::find($request->post('id'));
            $msg = "Coupan updated";
        } else {
            $model = new Coupan();
            $msg = "Coupan inserted";
            $model->status = 1;
        }
        $model->title = $request->post('title');
        $model->code = $request->post('code');
        $model->value = $request->post('value');
        $model->type = $request->post('type');
        $model->min_order_amt = $request->post('min_order_amt');
        $model->is_one_time = $request->post('is_one_time');

        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/coupan');
    }

    public function delete(Request $request, $id)
    {
        $model = Coupan::find($id);
        $model->delete();
        $request->session()->flash('message', 'Coupan deleted');
        return redirect('admin/coupan');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Coupan::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Coupan status updated');
        return redirect('admin/coupan');
    }
}
