<?php

namespace App\Http\Controllers;

use App\Models\Excursion;
use App\Models\Exhibition;
use App\Models\Status;
use App\Models\UserExcursion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExcursionController extends Controller
{
    public function index(Excursion $excursion) {
        $excursion = $excursion->all();
        return view('excursions.index', compact('excursion'));
    }

    public function showExcursion($id, Excursion $excursion) {
        $excursion = $excursion->find($id);

        if($excursion != Null) {
            $checkUser = 'default';
            if(Auth::check())
                $checkUser = $excursion->user->find(Auth::user()->id);

            $status = Status::all();
            return view('excursions.show', compact('excursion', 'checkUser', 'status'));
        }
        else
            abort(404);


    }

    public function writeExcurs($id, Excursion $excursion)
    {
        $excursion = $excursion->find($id);

        $checkUser = $excursion->user->find(Auth::user()->id);


        if($excursion != Null && $checkUser == Null) {
            UserExcursion::create([
                'user_id' => Auth::user()->id,
                'excursion_id' => $id,
            ]);

            return redirect()->route('profile.excurs')->with('status', 'Вы успешно записаны');
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
            return redirect()->back();
        }

        $excursion = Excursion::where('name', 'LIKE', '%'.$request->get('search').'%')->get();

        return view('excursions.index', compact('excursion'));
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

        Excursion::find($id)->update([
            'status_id' => $request->get('status'),
        ]);

        return back()->with('status', 'Статус успешно изменен!');
    }
}
