<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use App\Models\Status;
use App\Models\UserExhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExhibController extends Controller
{
    public function index(Exhibition $exhibition) {
        $exhibition = $exhibition->all();
        return view('exhib.index', compact('exhibition'));
    }

    public function showExhib($id, Exhibition $exhibition) {
        $exhibition = $exhibition->find($id);

        if($exhibition != Null) {

            $checkUser = 'default';
            if(Auth::check())
            $checkUser = $exhibition->user->find(Auth::user()->id);

            $status = Status::all();

            return view('exhib.show', compact('exhibition', 'checkUser', 'status'));
        }
        else
            abort(404);


    }

    public function writeExhib($id, Exhibition $exhibition)
    {
        $exhibition = $exhibition->find($id);

        $checkUser = $exhibition->user->find(Auth::user()->id);

        if($exhibition != Null && $checkUser == Null) {
            UserExhibition::create([
                'user_id' => Auth::user()->id,
                'exhibition_id' => $id,
            ]);

            return redirect()->route('profile.exhib')->with('status', 'Вы успешно записаны');
        }
        else
        {
            abort(404);
        }
    }

    public function search(Request $request) {
        $validator = Validator::make($request->all(), [
            'search' => 'required|string',
        ]);

        if ($validator->fails())
        {
            return back()->with('status', 'Ошибка');
        }

        $exhibition = Exhibition::where('name', 'LIKE', '%'.$request->get('search').'%')->get();

        return view('exhib.index', compact('exhibition'));
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|integer',
        ]);

        if ($validator->fails())
        {
            return back()->with('status', 'Ошибка');
        }

        Exhibition::find($id)->update([
            'status_id' => $request->get('status'),
        ]);

        return back()->with('status', 'Статус успешно изменен!');
    }
}
