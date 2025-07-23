<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function dashboard()
    {
        $getUserDetails = auth()->user();

        $fromDate = now()->subMonth();
        $toDate = now();
        // month ago - today
        $dateRange = $fromDate->format('d M') . ' - ' . $toDate->format('d M');
        // list of customers last month, paginate 10
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->whereBetween('created_at', [$fromDate, $toDate])
            ->orderBy('created_at', 'desc')
            ->get();
        // count of customers last month
        $monthlyCustomersCount = $users->count();

        return view('admin.dashboard', compact('getUserDetails','dateRange','monthlyCustomersCount','users'));
    }


    public function changePassword(){
        $getUserDetails = auth()->user();
        return view('admin.change_password', compact('getUserDetails'));
    }

    
    public function profileUpdate(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->update($request->validated());
        Session::flash('success', trans('translation.profile_updated_successfuly'));
        return redirect(route('changePassword'));
    }


    // public function passwordUpdate(UpdatePasswordRequest $request)
    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password|min:8',

        ]);
        $getUser = User::where('id',auth()->user()->id)->first();
        $getUser->password = Hash::make($request->password);
        $getUser->save();

        if ($getUser) {
            Session::flash('success', trans('translation.password_updated_successfuly'));
            return redirect(route('changePassword'));
        } else {
            Session::flash('error', trans('translation.error_while_updating_password'));
            return redirect(route('changePassword'));
        }
    }
}
