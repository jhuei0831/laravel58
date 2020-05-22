<?php

namespace App\Http\Controllers;

use App\Page;
use App\Navbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_pages = DB::table('pages')->get();
        return view('manage.page.index',compact('all_pages'));
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

        return view('manage.page.create');
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
        $page = new Page;
        $data = $request->validate([
            'menu_id' => ['nullable'],
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255','unique:pages,url'],
            'is_open' => ['required'],
            'is_slide' => ['required'],
        ]);

        foreach ($request->except('_token', '_method','files') as $key => $value) {
            if ($request->filled($key) && $request->filled($key) != NULL && $key != 'content') {
                $page->$key = $data[$key];
                if ($page->$key == '') {
                    $error += 1;
                }
            }
            else{
                $page->$key = NULL;
            }
        }

        $page->content = $request->input('content');
        $page->editor = Auth::user()->name;
        if ($error == 0) {
            $page->save();
        }
        else{
            return back()->withInput()->with('warning', '請確認輸入 !');
        }

        return back()->with('success','頁面新增成功 !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $page = Page::where('id',$id)->first();
        $navbars = Navbar::where('type', '=', '1')->get();
        return view('manage.page.edit',compact('page','navbars'));
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
        $page = Page::where('id',$id)->first();

        $data = $this->validate($request, [
            'menu_id' => ['nullable'],
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'is_open' => ['required'],
            'is_slide' => ['required'],
        ]);

        foreach ($request->except('_token','_method','files') as $key => $value) {
            if ($request->filled($key) && $request->filled($key) != NULL && $key != 'content') {
                $page->$key = $data[$key];
                if ($page->$key == '') {
                    $error += 1;
                }
            }
            else{
                $page->$key = NULL;
            }
        }
        $page->content = $request->input('content');
        $page->editor = Auth::user()->name;

        if ($error == 0) {
            $page->save();
        }
        else{
            return back()->withInput()->with('warning', '請確認輸入 !');
        }
        return back()->with('success','修改頁面成功 !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '4') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        Page::destroy($id);
        return back()->with('success','刪除頁面成功 !');
    }
}
