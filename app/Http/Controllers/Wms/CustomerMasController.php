<?php

namespace App\Http\Controllers\Wms;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wms\CustomerMaster;
use Illuminate\Support\Facades\Auth;

class CustomerMasController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:role list', ['only' => ['index', 'show']]);
        $this->middleware('can:role create', ['only' => ['create', 'store']]);
        $this->middleware('can:role edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:role delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = (new CustomerMaster)->newQuery();

        if (request()->has('search')) {
            $roles->where('cusname', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $roles->orderBy($attribute, $sort_order);
        } else {
            $roles->latest();
        }

        $roles = $roles->paginate(config('wms.paginate.per_page'))
                    ->onEachSide(config('wms.paginate.each_side'))
                    ->appends(request()->query());

        return Inertia::render('Wms/Customer-Master/Index', [
            'roles' => $roles,
            'filters' => request()->all('search'),
            'can' => [
                'create' => Auth::user()->can('role create'),
                'edit' => Auth::user()->can('role edit'),
                'delete' => Auth::user()->can('role delete'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = CustomerMaster::all()->pluck('cusname', 'id');

        return Inertia::render('Wms/Customer-Master/Create', [
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = CustomerMaster::create($request->all());

        if (! empty($request->permissions)) {
            $data->givePermissionTo($request->permissions);
        }

        return redirect()->route('wms.customer-master.index')
            ->with('message', 'Customer Master created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = CustomerMaster::all()->pluck('name', 'id');
        $roleHasPermissions = array_column(json_decode($data->permissions, true), 'id');

        return Inertia::render('Admin/Role/Show', [
            'role' => $role,
            'permissions' => $permissions,
            'roleHasPermissions' => $roleHasPermissions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions = Permission::all()->pluck('name', 'id');
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');

        return Inertia::render('Admin/Role/Edit', [
            'role' => $role,
            'permissions' => $permissions,
            'roleHasPermissions' => $roleHasPermissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role->update($request->all());
        $permissions = $request->permissions ?? [];
        $role->syncPermissions($permissions);

        return redirect()->route('admin.role.index')
            ->with('message', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role->delete();

        return redirect()->route('admin.role.index')
            ->with('message', __('Role deleted successfully'));
    }
}
