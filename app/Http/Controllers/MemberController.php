<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //從資料表 `users` 將所以資料取出，並進行分頁
        $all_users = DB::table('users')->paginate();
        //將取出的資料放在視圖manage/member/index
        return view('manage.member.index',compact('all_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        return view('manage.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'permission' => ['required', 'string', 'max:5', 'min:0'],
        ]);

        foreach ($request->except('_token','_method','password_confirmation') as $key => $value) {
            if ($request->filled($key) && $key == 'password') {
                $user->password = Hash::make($data['password']);
            }
            elseif ($request->filled($key)) {
                $user->$key = strip_tags(clean($data[$key]));
            }
        }

        if ($data) {
            $user->save();
        }

        return back()->with('success','會員新增成功 !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 取出要修改的會員資料
        $user = User::where('id',$id)->first();
        // 帶著會員資料進入修改頁面
        return view('manage.member.edit',compact('user'));
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

        $error = 0;
        $user = User::where('id',$id)->first();

        // 如果有輸入密碼
        if ($request->filled('password')) {
                $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:1', 'confirmed'],
                'permission' => ['required', 'integer', 'max:5', 'min:0'],
            ]);

            foreach ($request->except('_token','_method','password_confirmation') as $key => $value) {
                if ($request->filled($key) && $key == 'password') {
                    $user->password = Hash::make($data['password']);
                }
                elseif ($request->filled($key)) {
                    $user->$key = strip_tags(clean($data[$key]));
                    if ($user->$key == '') {
                        $error += 1;
                    }
                }
            }

            if ($error == 0) {
                $user->save();
            }
            else{
                return back()->withInput()->with('warning', '請確認輸入 !');
            }
        }
        else{

            $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'permission' => ['required', 'integer', 'max:5', 'min:0'],
            ]);

            // 逐筆進行htmlpurufier 並去掉<p></p>
            foreach ($request->except('_token','_method') as $key => $value) {
                if ($request->filled($key)) {
                    $user->$key = strip_tags(clean($data[$key]));
                    if ($user->$key == '') {
                        $error += 1;
                    }
                }
            }

            if ($error == 0) {
                $user->save();
            }
            else{
                return back()->withInput()->with('warning', '請確認輸入 !');
            }
        }

        return back()->with('success', '會員更新成功 !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', '會員刪除成功 !');
    }
}
