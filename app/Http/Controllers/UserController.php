<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValue;
use App\Http\Requests\UploadImageRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::findOrFail(Auth::id());
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        $data = [
            'user' => $user,
            'title' => "Profile",
            'cart' => $cart,
        ];
        return view('users.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        $data = [
            'user' => $user,
            'title' => "Edit Profile",
            'cart' => $cart,
        ];
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UploadImageRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        if ($request->hasFile('avatar')) {
            $filename = $request->file('avatar')->getClientOriginalName();
            $type = $request->file('avatar')->getClientOriginalExtension();
            $url = 'users/avatars/' . $user->id . '/' . $filename;

            $image = Image::make($request->file('avatar'))->resize(150, 150)->encode($type);
            Storage::disk('s3')->put($url, (string)$image, 'public');
            $user->update([
                'avatar' => $url,
            ]);
        }
        if ($request->birthday != null) {
            $user->update([
                'birthday' => $request->birthday,
            ]);
        }
        $user->update([
            'gender' => $request->gender,
            'name' => $request->name,
            'location' => $request->location,
            'notes' => $request->notes,
        ]);
        $user->save();
        return redirect()->route('user.index');
    }

    public function addBalance()
    {
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        $data = [
            'title' => 'Balance',
            'cart' =>$cart,
        ];
        return view('users.balance', $data);
    }
    public function getFormChangePassWord()
    {
//        echo auth()->user()->id;
//        $data = [
//            'user' => $user,
//            'title' => "Edit Profile",
//            'cart' => $cart,
//        ];
        $user = User::findOrFail(auth()->user()->id);
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        $data = [
            'user' => $user,
            'title' => "Edit Profile",
            'cart' => $cart,
        ];
        return view('users.changPasswordForm', $data);
    }
    public function changePassWord(Request $request)
    {
        //
        $user = User::findOrFail(auth()->user()->id);
        if (!$request->has('old_password')||!$request->has('password')||!$request->has('password_confirmation')) {
            return redirect()->back()->with(['error'=>'bạn cần nhập đầy đủ thông tin']);
        }

        if (strcmp($request->get('password'), $request->get('password_confirmation'))!=0) {
            return redirect()->back()->with(['error'=>'mật khẩu mới không khớp']);
        }
        if (!Hash::check($request['old_password'], Auth::User()->password)) {
            return redirect()->back()->with(['error'=>'mật khẩu cũ không đúng']);
        }


        $user->update([
            'password' => bcrypt($request->get('password'))
        ]);
        $user->save();
        return redirect()->route('user.index');
    }

    public function storeBalance(RequestValue $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->balance = $user->balance + $request->balance;
        $user->save();
        return redirect()->route('user.index');
    }
}
