<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;
use App\Role;

class UserController extends Controller
{

    public function __contruct(){
        $this->middleware('auth');
        
    }

    public function index(Request $req)
    {
        if($req->ajax()){
            $user = User::with('roles')->get();

            return DataTables::of($user)
            ->addColumn('no',function(){})
            ->addColumn('group',function($user){
                return $user->roles;
            })
            ->addColumn('action',function($user){
                    
            })
            ->make(true);
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),

            array(
                'role_id'           => 'required',
                'wilayah_id'        => 'required',
                'instansi_wilayah_id'       => 'required',
                'email'             => 'required|email',
                'name'              => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ),

            array(
                'role_id.required'      => 'Group tidak boleh kosong',
                'wilayah_id.required'   => 'Username harus 5 karakter',
                'instansi_wilayah_id.required'  => 'Instansi tidak boleh kosong',
                'email.required'        => 'Email tidak boleh kosong',
                'email.email'           => 'Email tidak valid',
                'name.required'        =>  'Name tidak boleh kosong',
                'password.required'=>'Password tidak boleh kosong!',
                'password.string'=>'Password harus berupa karakter huruf!',
                'password.min'=>'Password minimal 8 karakter',
                'password.confirm'=>'Password tidak sama!'
            )
        );

        if ($validator->fails()) {

            return redirect(route('users.create'))->withErrors($validator);

        }
        else{

      
            $user= new User;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $save = $user->save();
         
            if($save){
                $user->instances()->sync($request->instansi_wilayah_id);
                $user->wilayah_list()->sync($request->wilayah_id);
                $user->roles()->sync($request->role_id);
                return redirect()->route('users.index')->with('sukses','Berhasil menginput data pengguna!');
            }else{
                return redirect()->route('users.index')->with('gagal','Terjadi kesalahan!');
            }                     
            
        }  

     }
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = array();
        $element = Element::with('generateForm');

        foreach($element as $index=>$el) {
            $entities = "\Modules\Module".$el->variable->bidang->id."\Entities\Element".$el->id;
            $data[$index]=[
                'id'=>$el->id,
                'element'=>$el->name,
                'variable'=>$el->variable->name,
                'bidang'=>$el->variable->bidang->nama,
                'jumlah'=>$entities::where("created_by", $user->id)->orWhere('updated_by',$user->id)->get()->count()
            ];
        }
        
        return view('users.show',compact('user'), compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $roles              = Role::all();
        $data               = $user;
        return view('backend.users.edit',compact('roles','data')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),

            array(
                'role_id'           => 'required',
                'wilayah_id'        => 'required',
                'instansi_wilayah_id'       => 'required',
                'email'             => 'required|email|unique:users,email,' . $user->id . ",id",
                'name'              => 'required',
                'password'           => 'nullable|sometimes|string|min:8|confirmed',
            ),

            array(
                'role_id.required'      => 'Group tidak boleh kosong',
                'wilayah_id.required'   => 'Username harus 5 karakter',
                'instansi_wilayah_id.required'  => 'Instansi tidak boleh kosong',
                'email.required'        => 'Email tidak boleh kosong',
                'email.email'           => 'Email tidak valid',
                'name.required'        =>  'Name tidak boleh kosong',
                'password.string'=>'Password harus berupa karakter huruf!',
                'password.min'=>'Password minimal 8 karakter',
                'password.confirm'=>'Password tidak sama!'
            )
        );

        if ($validator->fails()) {

            return redirect(route('users.edit',['user'=>$user]))->withErrors($validator)->withInput();
        }

        try {
            \DB::beginTransaction();
                
            $user->save($request->all());
            $user->instances()->sync($request->instansi_wilayah_id);
            $user->wilayah_list()->sync($request->wilayah_id);
            $user->roles()->sync($request->role_id);            
            \DB::commit();
            
        }
        catch(\Exception $e){
            \DB::rollback();
            return redirect()->route('users.index')->with('gagal','Gagal merubah data ini!');
        }


        return redirect()->route('users.index')->with('sukses','sukses merubah data!');
    }
}
