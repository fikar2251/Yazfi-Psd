<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\{User, Cabang, Jabatan, Perusahaan, Project, TeamSales};
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index()
    {
        $sale = User::select('id','name')->role('supervisor')->where('id_jabatans', 2)->get(); 
        // dd($sales);
        $sales= TeamSales::leftJoin('users','users.id','=','team_sales_user.user_id')
        ->whereIn('team_sales_user.user_id',$sale)
        ->select('team_sales_user.id_manager','team_sales_user.user_id')
        ->groupBy('team_sales_user.user_id')
        ->get();
        // dd($sales);
    
        $manager = User::role('marketing')->where('id_jabatans', 1)->get();
        // dd($manager);

        return view ('hrd.sales.index',compact('sale','sales','manager'));
    }

    public function create(TeamSales $sale)
    {


        $roles = Role::get();

        $manager_marketing = User::role('marketing')->where('id_jabatans',1)->get();
        // dd($manager_marketing);

        $staff_marketing = User::role('marketing')->where('id_jabatans',2)->get();
        // dd($staff_marketing);

        $spv = User::role('supervisor')->get();
        // dd($spv);

        return view('hrd.sales.create', compact('roles','sale', 'manager_marketing', 'staff_marketing', 'spv'));
    }

    public function store(Request $request)
    {
        $sales_all = TeamSales::select('user_id')->where('user_id', $request->user_id)->get();
        // dd($sales_all);
        $sales = $request->input('id_sales', []);
      
        $attr= [];
        if(count($sales_all) == 0){
        DB::beginTransaction();
        foreach( $sales as $tim){
            $attr[]=[
                'id_sales' => $tim,
                'id_manager' => $request->id_manager,
                'user_id' => $request-> user_id
            ];
            // dd($attr);

        }
        
        TeamSales::insert($attr);
        DB::commit();
        return redirect()->route('hrd.sales.index')->with('success', 'Team Sales has been added');
    }else{

        return back()->with('error', 'Data Spv Sudah Pernah Dibuat');

    }

      
    }


    public function edit(User $sale)
    {
        
        $team = TeamSales::whereIn('user_id', $sale)->select('id_manager','user_id')->first();
        // dd($team);
    
        $roles = Role::get();
        
        $manager_marketing = User::role('marketing')->where('id_jabatans',1)->get();
        // dd($manager_marketing);

        $staff_marketing = User::role('marketing')->where('id_jabatans',2)->get();
        // dd($staff_marketing);

        $spv = User::role('supervisor')->get();
        
        return view('hrd.sales.edit', compact('spv','staff_marketing', 'manager_marketing','sale','team'));
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
        DB::beginTransaction();
        $sales = $request->input('id_sales', []);
        // dd($sales);
        // dd($request->all());
        $sale = TeamSales::where('user_id', $id)->get();
        foreach ($sale as $tim) {
            TeamSales::where('user_id', $tim->id)->delete();
            $tim->delete();
        }
        foreach ($sales as $key => $value) {
        TeamSales::where('user_id', $id)->updateorinsert([
                'id_sales' => $value,
                'id_manager' => $request->id_manager,
                'user_id' => $request-> user_id
            ]);
        }
            // foreach ($sales as $key => $value) {
            //     TeamSales::create([
            //     'id_sales' => $key,
            //     'id_manager' => $request->id_manager,
            //     'user_id' => $request-> user_id
            //     ]);
            // }
           
            DB::commit();
        
        return redirect()->route('hrd.sales.index')->with('success', 'Team Sales has been updated');
    }

    public function hapus($id)
    {
        $sales = TeamSales::where('user_id', $id)->get();
        // dd($sales);

        foreach ($sales as $tim) {
            TeamSales::where('user_id', $tim->id)->delete();

            $tim->delete();
            
        
        }
      
     
        return redirect()->route('hrd.sales.index')->with('success', 'Team Sales has been deleted');
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
