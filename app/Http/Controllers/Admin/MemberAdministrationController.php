<?php

namespace App\Http\Controllers\Admin;

use App\AdministrationMember;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberAdministrationController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->paginate(12);
        $data = [
            'users' => $users,
            'title' => "Member Administration",
        ];
        return view('admin.member-administration.index', $data);
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        $data=[
            'user' => $user,
            'title' => "Show user",
        ];
        return view('admin.member-administration.show', $data);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data=[
            'user' => $user,
            'title' => "Edit user",
        ];
        return view('admin.member-administration.edit', $data);
    }
    public function update(Request $request, $id)
    {
        //
        $user =User::findOrFail($id);
        $user->update([
           'level' => $request->level,
           'admin' => $request->account,
        ]);
        $user->save();
        return redirect()->route('admin.member.show', $user->id);
    }
    public function search(Request $request)
    {
        if ($request->has('content')) {
            if (is_numeric($request->get('content'))) {
                $query=User::where('id', $request->get('content'));
            } else {
                $query=User::where('name', 'LIKE', '%'.$request->get('content').'%');
            }
            $users=$query->paginate(12);
        }
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        $data = [
            'users' => $users,
            'title' => "Member Administration",
            'cart' => $cart,
            'filterParams'=>[
                'content' =>$request->get('content')
            ],
        ];
        return view('admin.member-administration.index', $data);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.member.index');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('admin.member.index');
    }
}
