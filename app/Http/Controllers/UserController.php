<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Browwing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    public function profile()
    {
        $peminjaman = Browwing::with(['user', 'book'])->where('user_id', Auth::user()->id)->get();
        return view('profile.profile', ['peminjaman' => $peminjaman]);
    }

    public function user()
    {
        $users = User::where('role', '!=', 'admin')->where('status', 'active')->get();
        return view('user.user', ['users' => $users]);
    }

    public function regisUser()
    {
        $regisUser = User::where('status', 'inactive')->where('role', '!=', 'admin')->get();
        return view('user.regis-user', ['regisUser' => $regisUser]);
    }

    public function detailUser($slug)
    {
        $user = User::where('slug', $slug)->first();
        $peminjaman = Browwing::with(['user', 'book'])->where('user_id', $user->id)->get();
        return view('user.detail-user', ['user' => $user, 'peminjaman' => $peminjaman]);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $check = $user->save();
        if($check){
            Alert::success('Success', 'User approved successfully!');
        }else{
            Alert::error('Error', 'User approval failed!');
        }
        return back();
    }

    public function ban($slug)
    {
        $user = User::where('slug', $slug)->first();
        if($user){
            $user->delete();
            Alert::success('Success', 'Data berhasil di hapus sementara');
        }
        return redirect('users');
    }

    public function showUser()
    {
        $showUser = User::onlyTrashed()->get();
        return view('user.show-ban-user', ['showUser' => $showUser]);
    }

    public function restoreUser($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();
        Alert::success('Success', 'Data berhasil di kembalikan!');
        return redirect('users');
    }

    public function permanentUser($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $userBrowwing = Browwing::where('user_id', $user->id)->get();
        foreach ($userBrowwing as $userBrowwing) {
            $userBrowwing->delete();
        }
        if($user){
            $user->forceDelete();
            Alert::success('Success', 'Data berhasil di hapus permanen!');
        }else{
        Alert::success('Success', 'Data berhasil di hapus!');
        }
        return redirect()->route('show-ban-users');
    }
}
