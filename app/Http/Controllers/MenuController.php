<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Navbar;
use App\Page;
use App\Notice;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_menus = Menu::all();
        $all_navbars = Navbar::all();
        return view('manage.menu.index',compact('all_menus','all_navbars'));
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
        return view('manage.menu.create');
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
        $menu = new Menu;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255','unique:menus,name'],
            'navbar_id' => ['required','integer'],
            'link' => ['nullable'],
            'is_open' => ['required'],
            'is_list' => ['required'],
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key) && $request->filled($key) != NULL) {
                $menu->$key = strip_tags(clean($data[$key]));
                if ($menu->$key == '') {
                    $error += 1;
                }
            }
            else{
                $menu->$key = NULL;
            }
        }

        if ($error == 0) {
            // 寫入log
            Log::write_log('menus',$request->all());
            $menu->save();
        }
        else{
            return back()->withInput()->with('warning', '請確認輸入 !');
        }
        // 寫入log
        Log::write_log('menus',$request->all());

        // 寫入log
        Log::write_log('menus',$request->all());

        return back()->with('success', '選單新增成功 !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        $menu = Menu::where('id',$id)->first();

        return view('manage.menu.edit',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $error = 0;
        $menu = Menu::where('id', $id)->first();

        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'navbar_id' => ['required','integer'],
            'link' => ['nullable','string'],
            'is_open' => ['required','boolean'],
            'is_list' => ['required','boolean'],
        ]);

        // 逐筆進行htmlpurufier 並去掉<p></p>
        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key) && $request->filled($key) != NULL) {
                $menu->$key = strip_tags(clean($data[$key]));
                if ($menu->$key == '') {
                    $error += 1;
                }
            }
            else{
                $menu->$key = NULL;
            }
        }

        if ($error == 0) {
            // 寫入log
            Log::write_log('menus',$request->all());
            $menu->save();
        }
        else{
            return back()->withInput()->with('warning', '請確認輸入 !');
        }

        return back()->with('success', '修改選單成功 !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '4') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        // 寫入log
        Log::write_log('menus',Menu::where('id', $id)->first());

        Menu::destroy($id);
        return back()->with('success', '刪除選單成功 !');
    }

    //拖曳排序
    public function sort(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        $menus = Menu::all();

        foreach ($menus as $menu) {
            foreach ($request->order as $order) {
                if ($order['id'] == $menu->id) {
                    $menu->update(['sort' => $order['position']]);
                }
            }
        }
        // 寫入log
        $sort = DB::table('menus')->select('name','sort')->orderby('sort')->get();
        Log::write_log('menus',$sort,'排序');

        return response('Update Successfully.', 200);
    }

    /**
     * [menus description]
     * @param  [type] $nav  [選取的導覽列]
     * @param  [type] $menu [選取的選單]
     * @param  [type] $menus_nav [導覽列下所有的選單資料]
     * @param  [type] $select_menu [選取的選單資料]
     * @param  [type] $menu_pages [選取選單下所有頁面的資料]
     * @return [type]       [description]
     */
    public function menus($nav,$menu)
    {
        $navbar = Navbar::where('name',$nav)->first();
        $menus_nav = Menu::where('navbar_id',$navbar->id)->where('is_open',1)->orderby('sort')->get();
        $select_menu = Menu::where('name',$menu)->first();
        if (empty($select_menu)) {
            abort(404);
        }

        if ($select_menu->is_list == '1') {
            $menu_pages = Page::where('is_open',1)->orderby('updated_at','desc')->paginate(10);
        }
        else {
            $menu_pages = Page::where('menu_id',$select_menu->id)->where('is_open',1)->orderby('updated_at','desc')->first();
        }

        return view('menu',compact('menus_nav','select_menu','navbar','menu_pages'));
    }
}
