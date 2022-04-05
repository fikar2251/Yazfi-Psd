<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\{User, Cabang, Jabatan, Perusahaan, Project};
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->get();

        return view('hrd.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        $user = new User();
        $perusahaans = Perusahaan::get();
        $jabatans = Jabatan::get();
        $projects = Project::get();
        $perkawinans = DB::table('status_pernikahans')->get();
        $agamas = DB::table('agamas')->get();

        $noUrutAkhir = \App\User::max('id');
        // dd($noUrutAkhir);
        $nourut =   sprintf("%02s", abs($noUrutAkhir + 1))  . sprintf("%05s", abs($noUrutAkhir + 1));

        return view('hrd.users.create', compact('roles', 'nourut','user', 'jabatans', 'perusahaans', 'projects','perkawinans','agamas'));
    }

    public function store(StoreUserRequest $request)
    {
        dd($request->all());

        $attr = $request->all();
        $image = $request->file('image');
        $imageUrl = $image->storeAs('images/users', \Str::random(15) . '.' . $image->extension());
        $attr['image'] = $imageUrl;
        $attr['is_active'] = 1;
        $attr['password'] = Hash::make($request->password);

        $user = User::create($attr);

        $user->assignRole($request->input('role'));

        return redirect()->route('hrd.users.index')->with('success', 'User has been added');
    }


    public function edit(User $user)
    {
        $roles = Role::get();
        $perusahaans = Perusahaan::get();
        $jabatans = Jabatan::get();
        $projects = Project::get();
        $perkawinans = DB::table('status_pernikahans')->get();
        $agamas = DB::table('agamas')->get();

        $noUrutAkhir = \App\User::max('id');
        // dd($noUrutAkhir);
        $nourut =   sprintf("%02s", abs($noUrutAkhir + 1))  . sprintf("%05s", abs($noUrutAkhir + 1));

        return view('hrd.users.edit', compact('user', 'roles','nourut', 'perusahaans', 'jabatans', 'projects','perkawinans','agamas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $attr = $request->all();
        if ($request->input('password') == null) {
            $attr['password'] = $user->password;
        } else {
            $attr['password'] =  Hash::make($request->password);
        }

        $image = $request->file('image');

        if ($request->file('image')) {
            Storage::delete($user->image);
            $imageUrl = $image->storeAs('images/users', \Str::random(15) . '.' . $image->extension());
            $attr['image'] = $imageUrl;
        } else {
            $attr['image'] = $user->image;
        }

        $user->update($attr);
        $user->syncRoles($request->input('role'));

        return redirect()->route('hrd.users.index')->with('success', 'User has been updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('hrd.users.index')->with('success', 'User has been deleted');
    }
    public function whereProject(Request $request)
    {
        $data = DB::table('perusahaans')
            ->leftJoin('projects', 'perusahaans.id', '=', 'projects.id_perusahaan')
            ->select('projects.nama_project')
            ->groupBy('projects.nama_project')
            ->where('perusahaans.id', $request->id)->get();
        return $data;
        dd($data);
    }
}
