<?php

namespace App\Http\Controllers;

use App\Models\Excursion;
use App\Models\User;
use App\Models\UserExcursion;
use App\Models\UserExhibition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function settings() {
        return view('profile.settings');
    }

    public function changePassword(Request $request)
    {
        $data = request()->validate([
            'oldpassword' => ['required', 'string', 'max:150'],
            'password' => ['required', 'string', 'min:8', 'max:150', 'confirmed'],
        ]);

        if(!Hash::check($data['oldpassword'], auth()->user()->password)){
            return back()->with("status", "Текущий пароль неверен!");
        }

        User::find(auth()->user()->id)->update([
            'password' => Hash::make($data['password'])
        ]);

        return back()->with('status', 'Пароль успешно изменён');
    }

    public function image(User $user)
    {
        $user = $user->find(Auth::user()->id);

        $data = request()->validate([
            'file' => ['required', 'image', 'dimensions:max_width=350px,max_height=250px'],
        ]);

        $imageName = time() . '.' . $data['file']->extension();

        $data['file']->move(public_path('img/iconUser/'), $imageName);

        $file = $imageName;

        if($user->photo != 'default.png') {
            unlink(public_path('img/iconUser' . '/' . $user->photo));
        }

        $DD = User::where('id', Auth::user()->id)->update([
            'photo' => $file,
        ]);

        return back()->with('status', 'Картинка успешно применена');

    }

    public function excurs()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.excurs', compact('user'));
    }

    public function exhib()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.exhib', compact('user'));
    }

    public function excursDelete($id)
    {
        UserExcursion::where('user_id', Auth::user()->id)->where('excursion_id', $id)->delete();

        return back()->with('status', 'Запись успешно отменена');
    }

    public function exhibDelete($id)
    {
        UserExhibition::where('user_id', Auth::user()->id)->where('exhibition_id', $id)->delete();

        return back()->with('status', 'Запись успешно отменена');
    }
}
