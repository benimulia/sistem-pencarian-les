<?php

namespace App\Http\Controllers;


use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function userAll()
    {
        return User::orderBy('name', 'ASC')->get();
    }

    public function getUserRole()
    {
        if (!auth()->check()) {
            return null;
        }

        $user_id = auth()->user()->id;
        $userrole = DB::table('model_has_roles')
            ->select('model_has_roles.*')
            ->where('model_id', $user_id)
            ->first();

        return $userrole;
    }

    public function getUserId()
    {
        if (!auth()->check()) {
            return null;
        }

        $userid = auth()->user()->id;

        return $userid;
    }

    public function index(Request $request)
    {
        $data = User::orderBy('name', 'ASC')->paginate(5);
        return view('users.index', compact('data'), [
            "title" => "List User"
        ])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'), [
            "title" => "Tambah User"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'), [
            "title" => "Show User"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'), [
            "title" => "Edit User"
        ]);
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request)
    // {
    //     $userIdsToDelete = $request->input('users_to_delete');
    //     dd($userIdsToDelete);

    //     if (!empty($userIdsToDelete)) {
    //         User::whereIn('id', $userIdsToDelete)->delete();
    //         return redirect()->route('users.index')->with('success', 'Users deleted successfully');
    //     }

    //     return redirect()->route('users.index')->with('error', 'No users selected for deletion');
    // }



    public function verify(Request $request)
    {
        $userIdsToVerify = $request->input('users_verified');
        $userIdsToDelete = $request->input('users_to_delete');

        // Ambil semua pengguna yang telah diverifikasi sebelumnya
        $userOriginalVerification = User::whereIn('id', $userIdsToVerify)->whereNotNull('email_verified_at')->pluck('id')->toArray();

        // Verifikasi pengguna yang baru dicentang (berbeda dengan yang telah diverifikasi sebelumnya)
        $newUsersToVerify = array_diff($userIdsToVerify, $userOriginalVerification);

        if (!empty($newUsersToVerify)) {
            $usersToVerify = User::whereIn('id', $newUsersToVerify)->get();

            foreach ($usersToVerify as $user) {
                $user->update(['email_verified_at' => now()]);
                $user->notify(new EmailNotification());
                printf('kirim email ke : ' . $user->email);
            }
        }

        // Hapus pengguna yang dipilih
        if (!empty($userIdsToDelete)) {
            User::whereIn('id', $userIdsToDelete)->delete();
        }

        return redirect()->route('users.index')->with('success', 'Data pengguna sudah diproses');
    }

    public function changePasswordForm()
    {
        return view('users.change-password', [
            "title" => "Edit User"
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();

        // Gunakan Validator untuk memvalidasi input
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);


        // Periksa apakah validasi gagal
        if ($validator->fails()) {
            return redirect()->route('change-password')
                ->withErrors($validator)
                ->withInput();
        }

        // Periksa kecocokan password saat ini
        if (Hash::check($request->current_password, $user->password)) {
            $user->update(['password' => Hash::make($request->new_password)]);
            return redirect()->route('change-password')->with('success', 'Password has been changed.');
        } else {
            $validator->errors()->add('current_password', 'Current password is incorrect.');
            return redirect()->route('change-password')
                ->withErrors($validator)
                ->withInput();
        }
    }
}
