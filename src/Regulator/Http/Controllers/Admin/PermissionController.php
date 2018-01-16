<?php

namespace Jameron\Regulator\Http\Controllers\Admin;

use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Jameron\Regulator\Models\Permission;
use App\Http\Controllers\Controller;
use Jameron\Regulator\Http\Requests\PermissionRequest;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class PermissionController extends Controller
{
    public $columns;

    public function getIndexViewColumns()
    {
        if(isset(config('regulator.roles')[Auth::user()->roles()->first()->slug])) {
            $this->columns = collect(config('regulator.roles')[Auth::user()->roles()->first()->slug]['permissions_columns']);
        }
        return $this->columns;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request->get('search')) ? $request->get('search') : null;
        $sort_by = ($request->get('sortBy')) ? $request->get('sortBy') : 'name';
        $order = ($request->get('order')) ? $request->get('order') : 'ASC';

        $permissions = Permission::select('regulator_permissions.*');

        if ($search) {
            $permissions = $permissions->where(function ($query) use ($search) {
                $query->where('regulator_permissions.name', 'LIKE', '%'.$search.'%');
            });
        }

        if ($sort_by) {
            $permissions = $permissions
                ->orderBy($sort_by, $order);
        }

        $permissions = $permissions->paginate(config('admin.paginate.count'));

        $data = [];
        $data['search'] = [
            'show' => config('regulator.permission.index.search')['show'],
            'placeholder' => 'Search permissions by name',
            'button_text' => 'Search',
			'icon' => 'search',
            'route' => '/permissions/search',
            'string' => $search
        ];
        
        $data['create_button'] = [
                'show' => true,
            'text'  => 'Create System',
            'route' => '/permissions/create'
        ];
        $data['show_update'] = true;
        $data['show_delete'] = false;

        $data['resource_route'] = config('regulator.role.resource_route');
        $data['permissions'] = [
            'create' => 'create_roles',
            'read' => 'read_roles',
            'update' => 'update_roles',
            'delete' => 'delete_roles'
        ];
        $data['sort_by'] = $sort_by;
        $data['order'] = $order;
        $data['items'] = $permissions;
        $data['columns'] = $this->getIndexViewColumns();

        return view('regulator::admin.permissions.index')
            ->with($data);
    }

    public function create()
    {
        return view('regulator::admin.permissions.create');
    }

    public function store(PermissionRequest $request)
    {
        $permission = new Permission();
        $permission->name = $request->get('name');
        $permission->slug = $request->get('slug');
        $permission->save();

        return redirect('/admin/permissions')
            ->with('success_message', 'Saved');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permission = Permission::where('id', $id)
            ->first();

        return view('regulator::admin.permissions.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::where('id', $id)
            ->firstOrFail();
        $permission->name = $request->get('name');
        $permission->slug = $request->get('slug');
        $permission->save();

        return redirect('admin/permissions')
            ->with('success_message', 'Saved');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);

        if ($permission) {
            $permission->delete();
            return redirect('admin/permissions')->with('success_message', 'Permission was deleted.');
        }
    }


    // Takes in array of objects
    public function sortBy($array_of_objects, $sort_by=null, $order, $page)
    {
        $collection = new Collection($array_of_objects);
        if ($sort_by) {
            if ($order=='desc') {
                $sorted = $collection->sortBy(function ($role) use ($sort_by) {
                    return $role->{$sort_by};
                })->reverse();
            } elseif ($order=='asc') {
                $sorted = $collection->sortBy(function ($role) use ($sort_by) {
                    return $role->{$sort_by};
                });
            }
        } else {
            $sorted = $collection;
        }

        $num_per_page = 20;
        if (!$page) {
            $page = 1;
        }

        $offset = ($page - 1) * $num_per_page;
        $sorted = $sorted->splice($offset, $num_per_page);

        return  new Paginator($sorted, count($array_of_objects), $num_per_page, $page);
    }
}
