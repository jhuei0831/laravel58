<?php

namespace App\Http\Controllers;

use App\Navbar;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavbarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_navbars = Navbar::all();
        return view('manage.navbar.index',compact('all_navbars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->permission < '2') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        return view('manage.navbar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '2') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $error = 0;
        $navbar = new Navbar;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255','unique:navbars,name'],
            'type' => ['required'],
            'link' => ['nullable'],
            'is_open' => ['required'],
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key) && $request->filled($key) != NULL) {
                $navbar->$key = strip_tags(clean($data[$key]));
                if ($navbar->$key == '') {
                    $error += 1;
                }
            }
            else{
                $navbar->$key = NULL;
            }
        }

        if ($error == 0) {
            // 寫入log
            Log::write_log('navbars',$request->all());
            $navbar->save();
        }
        else{
            return back()->withInput()->with('warning', '請確認輸入 !');
        }

        return back()->with('success', '導覽列新增成功 !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Navbar  $navbar
     * @return \Illuminate\Http\Response
     */
    public function show(Navbar $navbar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Navbar  $navbar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $navbar = Navbar::where('id',$id)->first();
        return view('manage.navbar.edit',compact('navbar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $error = 0;
        $navbar = Navbar::where('id', $id)->first();

        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'link' => [ 'nullable'],
            'type' => ['required'],
            'is_open' => ['required'],
        ]);

        // 逐筆進行htmlpurufier 並去掉<p></p>
        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key) && $request->filled($key) != NULL) {
                $navbar->$key = strip_tags(clean($data[$key]));
                if ($navbar->$key == '') {
                    $error += 1;
                }
            }
            else{
                $navbar->$key = NULL;
            }
        }
        if ($request->filled('link') == null) {
            $navbar->link = NULL;
        }

        if ($error == 0) {
            // 寫入log
            Log::write_log('navbars',$request->all());
            $navbar->save();
        }
        else{
            return back()->withInput()->with('warning', '請確認輸入 !');
        }

        return back()->with('success', '修改導覽列成功 !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Navbar  $navbar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '4') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        // 寫入log
        Log::write_log('navbars',Navbar::where('id',$id)->first());

        Navbar::destroy($id);
        return back()->with('success', '刪除導覽列成功 !');
    }

    //拖曳排序
    public function sort(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        $navbars = Navbar::all();

        foreach ($navbars as $navbar) {
            foreach ($request->order as $order) {
                if ($order['id'] == $navbar->id) {
                    $navbar->update(['sort' => $order['position']]);
                }
            }
        }
        $sort = DB::table('navbars')->select('name','sort')->orderby('sort')->get();
        Log::write_log('navbars',$sort,'排序');

        return response('Update Successfully.', 200);
    }
}
