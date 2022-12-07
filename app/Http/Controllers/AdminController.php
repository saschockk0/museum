<?php

namespace App\Http\Controllers;

use App\Models\Excursion;
use App\Models\Exhibition;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use App\Models\UserExcursion;
use App\Models\UserExhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(Status $statuses, Excursion $excursion, Exhibition $exhibition, UserExcursion $userExcursion, UserExhibition $userExhibition, User $users, Role $roles) {
        $statuses = $statuses->all();
        $excursion = $excursion->all();
        $exhibition = $exhibition->all();
        $userExcursion = $userExcursion->all();
        $userExhibition = $userExhibition->all();

        $users = $users->where('id', '!=', Auth::user()->id)->whereNotIn('role_id', ['2'])->get();
        $roles = $roles->where('id', '!=', '2')->get();
        $staff = $users->where('role_id', '3');



        return view('admin.index', compact('statuses', 'excursion', 'exhibition', 'userExcursion', 'userExhibition', 'users', 'roles', 'staff'));
    }

    public function createExcurs()
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'min: 5', 'max:255'],
            'description' => ['required', 'string', 'min: 5', 'max:355'],
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date'],
            'places' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'file' => ['required', 'image'],
        ]);

        $imageName = time() . '.' . $data['file']->extension();

        $data['file']->move(public_path('img/excurs/'), $imageName);

        $file = $imageName;

        Excursion::create([
            'name' => $data['title'],
            'description' => $data['description'],
            'date_start' => $data['date_start'],
            'date_end' => $data['date_end'],
            'places' => $data['places'],
            'price' => $data['price'],
            'photo' => $file,
        ]);

        return back()->with('status', 'Экскурсия успешно добавлена');

    }

    public function deleteExcurs($id, Excursion $excursion) {
        $excursion = $excursion->find($id);

        if($excursion != Null) {
            dd($excursion);
        }
        else
            abort(404);
    }

    public function createExhib()
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'min: 5', 'max:255'],
            'description' => ['required', 'string', 'min: 5', 'max:355'],
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date'],
            'places' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'file' => ['required', 'image']
        ]);

        $imageName = time() . '.' . $data['file']->extension();

        $data['file']->move(public_path('img/exhib/'), $imageName);

        $file = $imageName;

        Exhibition::create([
            'name' => $data['title'],
            'description' => $data['description'],
            'date_start' => $data['date_start'],
            'date_end' => $data['date_end'],
            'places' => $data['places'],
            'price' => $data['price'],
            'photo' => $file,
        ]);

        return back()->with('status', 'Выставка успешно добавлена');
    }

    public function roles(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required|integer',
            'role' => 'required|integer',
        ]);

        if ($validator->fails())
        {
            return redirect()->back();
        }

        // dd($request->get('user'));

        $user = $user->where('id', $request->get('user'));

        if($user != Null) {
            $user->update([
                'role_id' => $request->get('role'),
            ]);

            return back()->with('status', 'Роль успешно изменена');
        }
        else
            abort(404);
    }

    public function excursDeleteUser($user, $excurs)
    {
        UserExcursion::where('user_id', $user)->where('excursion_id', $excurs)->delete();

        return back()->with('status', 'Запись успешно отменена');
    }

    public function exhibDeleteUser($user, $excurs)
    {
        UserExhibition::where('user_id', $user)->where('exhibition_id', $excurs)->delete();

        return back()->with('status', 'Запись успешно отменена');
    }
}
