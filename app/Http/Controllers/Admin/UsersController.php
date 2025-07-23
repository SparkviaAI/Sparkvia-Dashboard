<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role as RoleModel;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }


    // public function list(Request $request)
    // {
    //     $columns = array(
    //         0 => '',
    //         1 => 'id',
    //         2 => 'name',
    //         3 => 'email',
    //         4 => 'email_verified_at',
    //         5 => 'user_roles',
    //         6 => 'options'
    //     );


    //     $limit = $request->input('length');
    //     $order = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search.value');
    //     $start = $request->input('start');

    //     if ($order == 'id') {
    //         $order = "users.id";
    //     }

    //     $query = User::with('roles')
    //         ->select('users.*', DB::raw('group_concat(roles.title SEPARATOR ", ") as user_roles'), 'wallets.balance_in_wallet')
    //         ->join('role_user', 'role_user.user_id', '=', 'users.id')
    //         ->join('roles', 'role_user.role_id', '=', 'roles.id')
    //         ->leftJoin('wallets', 'wallets.user_id', '=', 'users.id') 
    //         ->groupBy('users.id', 'wallets.balance_in_wallet');

    //     $totalData = count($query->get());

    //     $totalFiltered = count($query->keywords($search)->get());

    //     $users = $query
    //         ->keywords($search)
    //         ->orderBy($order, $dir)
    //         ->offset($start)
    //         ->limit($limit)
    //         ->get();

    //     $data = array();
    //     if (!empty($users)) {
    //         foreach ($users as $user) {
    //             $roles = '';
    //             foreach ($user->roles as $item) {
    //                 $roles .= '    <span class="badge badge-info">' . $item->title . ' </span>';
    //             }
    //             $nestedData[''] = '';
    //             $nestedData['DT_RowId'] = $user->id;
    //             $nestedData['id'] = $user->id;
    //             $nestedData['name'] = $user->name ?? '';
    //             $nestedData['email'] = $user->email ?? '';
    //             $nestedData['email_verified_at'] = $user->email_verified_at?->format(dateTimeFormat()) ?? '';
    //             $nestedData['user_roles'] = $roles;
    //             $nestedData['options'] = '';
    //             $nestedData['balance_in_wallet'] = $user->balance_in_wallet ?? "0";
    //             $data[] = $nestedData;
    //         }
    //     }

    //     $json_data = array(
    //         "draw" => intval($request->input('draw')),
    //         "recordsTotal" => intval($totalData),
    //         "recordsFiltered" => intval($totalFiltered),
    //         "data" => $data
    //     );

    //     echo json_encode($json_data);
    // }

    public function list(Request $request)
    {
        $columns = array(
            0 => '',
            1 => 'id',
            2 => 'name',
            3 => 'email',
            4 => 'email_verified_at',
            5 => 'user_roles',
            6 => 'options'
        );

        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $start = $request->input('start');

        if ($order == 'id') {
            $order = "users.id";
        }

        $query = User::with('roles')
            ->select('users.*', DB::raw('group_concat(roles.name SEPARATOR ", ") as user_roles'), 'wallets.balance_in_wallet')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->leftJoin('wallets', 'wallets.user_id', '=', 'users.id')
            ->groupBy('users.id', 'wallets.balance_in_wallet');

        $totalData = $query->count();

        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'LIKE', "%{$search}%")
                ->orWhere('users.email', 'LIKE', "%{$search}%")
                ->orWhere('users.username', 'LIKE', "%{$search}%")
                ->orWhere('users.discord_id', 'LIKE', "%{$search}%")
                ->orWhere('roles.name', 'LIKE', "%{$search}%");
            });
        }

        $totalFiltered = $query->count();

        $users = $query
            ->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)
            ->get();

        $data = array();
        if (!empty($users)) {
            foreach ($users as $user) {
                $roles = '';
                foreach ($user->roles as $item) {
                    $roles .= '    <span class="badge badge-info">' . $item->name . ' </span>';
                }
                $nestedData[''] = '';
                $nestedData['DT_RowId'] = $user->id;
                $nestedData['id'] = $user->id;
                $nestedData['name'] = $user->name ?? '';
                $nestedData['username'] = $user->username ?? '';
                $nestedData['discord_id'] = $user->discord_id ?? '';
                $nestedData['email'] = $user->email ?? '';
                // $nestedData['email_verified_at'] = $user->email_verified_at?->format(dateTimeFormat()) ?? '';
                $nestedData['user_roles'] = $roles;
                $nestedData['options'] = '';
                $nestedData['balance_in_wallet'] = $user->balance_in_wallet ?? "0";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        return response()->json($json_data);
    }



    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $roles = Role::pluck('title', 'id');
    //     return view('admin.users.create', compact('roles'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreUserRequest $request)
    // {
    //     $user = User::create($request->validated());
    //     $user->roles()->sync($request->input('roles', []));
    //     return redirect(route('users.index'));
    // }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     $user->load('roles');
    //     return view('admin.users.show', compact('user'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(User $user)
    // {
    //     $roles = Role::pluck('title', 'id');
    //     $user->load('roles');
    //     return view('admin.users.edit', compact('roles', 'user'));
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateUserRequest $request, User $user)
    // {
    //     $user->update($request->all());
    //     $user->roles()->sync($request->input('roles', []));
    //     return redirect(route('users.index'));
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $subdomain, User $user)
    // {
    //     if ($user->is($user->currentTenant->owner)) {
    //         return back()->with('error', 'Error while Deleting');
    //     }
    //     $user->delete();
    //     return back();
    // }


    public function create()
    {
        $roles = Role::pluck('name', 'id'); // Adjusted for Spatie
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->syncRoles($request->input('roles', [])); // Adjusted for Spatie
        Session::flash('success', trans('translation.user_added_successfully'));
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('roles');
        // dd($user);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id'); // Adjusted for Spatie
        $user->load('roles');
        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
         * Update the specified resource in storage.
         */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        Session::flash('success', trans('translation.user_updated_successfully'));
        // $user->syncRoles($request->input('roles', [])); // Adjusted for Spatie
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // if ($user->is($user->currentTenant->owner)) {
        //     return back()->with('error', 'Error while Deleting');
        // }
        $user->delete();
        Session::flash('success', trans('translation.question_deleted_successfully'));
        return back();
    }


    public function massDestroy(MassDestroyUserRequest $request)
    {
        if (is_integer(array_search(User::STATIC_ADMIN_DATABASE_ID, $request->validated('ids')))) {
            Session::flash('error', trans('translation.cannot_delete_admin!'));
            return redirect(route('users.index'));
        }
        User::whereIn('id', $request->validated('ids'))->delete();
        Session::flash('success', trans('translation.multiple_deletion_successful'));
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function walletDetails(Request $request){
        // dd($request->all());
        $getUser = User::where('id',$request->userId)->first();
        // return response()->json($getUser);
        // return response($getUser, Response::HTTP_OK);
        $json_data = array(
            "getUser" => $getUser
        );
        echo json_encode($json_data);
    }

    
    public function saveTokens(Request $request)
    {
        // dd($request->all());
        try {
            $userId = $request->input('userId');
            $tokensToAdd = $request->input('add_tokens');
            $getWallet = Wallet::where('user_id',$userId)->first();
            // dd($getWallet);
            $newAmount = $getWallet->balance_in_wallet + $tokensToAdd;
            if($getWallet->balance_in_wallett >= 10000){
                $getWallet->balance_in_wallet = 10000;
            } else{
                $getWallet->balance_in_wallet = $tokensToAdd;
            }
            $getWallet->save();
            if($getWallet){
                Session::flash('success', trans('translation.tokens_added_successfully!'));
                return response()->json([
                    'success' => trans('translation.tokens_added_successfully!'),
                ]);
                // return response()->json()->with('success', 'tokens_added_successfully!');
            }else{
                // return response()->json()->with('error', 'failed_to_add_tokens');
                Session::flash('success', trans('translation.failed_to_add_tokens'));

                return response()->json([
                    'error' => trans('translation.failed_to_add_tokens'),
                ], 422); // Set appropriate status code for errors
            }
        } catch (\Exception $e) {
            Session::flash('success', trans('translation.failed_to_add_tokens'));
            return response()->json([
                'error' => trans('translation.failed_to_add_tokens'),
            ], 422); // Set appropriate status code for errors
            // return response()->json()->with('error', 'failed_to_add_tokens');
        }
    }
}
