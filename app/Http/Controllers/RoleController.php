<?php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Support\Str;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$roles = Role::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null || 
            $request->input('page') == '') {
            $roles = $roles->get();
        } else {
            $roles = $roles->paginate();
        }

        $data = [
            'success' => true,
            'roles' => $roles
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();

        $role = new Role;

        $role->name = $validated['name'] ?? null;
		$role->slug = $validated['slug'] ?? null;
		$role->permissions = $validated['permissions'] ?? null;
		
        $role->save();

        $data = [
            'success'       => true,
            'role'   => $role
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $data = [
            'success' => true,
            'role' => $role
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validated = $request->validated();

        $role->name = $validated['name'] ?? null;
		$role->slug = $validated['slug'] ?? null;
		$role->permissions = $validated['permissions'] ?? null;
		
        $role->save();

        $data = [
            'success'       => true,
            'role'   => $role
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {   
        $role->delete();

        $data = [
            'success' => true,
            'role' => $role
        ];

        return response()->json($data);
    }
}