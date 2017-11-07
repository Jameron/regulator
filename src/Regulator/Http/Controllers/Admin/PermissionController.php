<?php

namespace Jameron\Regulator\Http\Controllers\Admin;

use DB;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Jameron\Regulator\Models\Permission;
use App\Http\Controllers\Controller;
use Jameron\Regulator\Http\Requests\PermissionRequest;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class PermissionController extends Controller
{
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

        // new
        if (! $search) {
            switch ($sort_by) {

            case 'name':

                $permissions = Permission::select('regulator_permissions.*')
                                    ->orderBy('regulator_permissions.name', $order)
                                    ->paginate(20);

                break;

            case 'slug':

                $permissions = Permission::select('regulator_permissions.*')
                    ->orderBy('regulator_permissions.slug', $order)
                    ->paginate(20);

                break;

            }
        } elseif ($search) {

            $permissions = Permission::select('regulator_permissions.*')
                ->orderBy('regulator_permissions.name', $order)
                ->where(function ($query) use ($search) {
                    $query->where('regulator_permissions.name', 'LIKE', '%'.$search.'%');
                })->paginate(20);

        } 

        return view('regulator::admin.permissions.index', compact('permissions','search','sort_by','order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('regulator::admin.permissions.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission();
        $permission->name = $request->get('name');
        $permission->slug = $request->get('slug');
        $permission->save();

        return redirect('/admin/permissions')
            ->with('success_message', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $permission = Permission::where('id', $id)
            ->first();

       return view('regulator::admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
		if ($sort_by)
		{

			if ($order=='desc') {
				$sorted = $collection->sortBy(function($role) use ($sort_by)
				{
					return $role->{$sort_by};
				})->reverse();
			} else if ($order=='asc') {
				$sorted = $collection->sortBy(function($role) use ($sort_by)
                {
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

		$offset = ( $page - 1) * $num_per_page;
		$sorted = $sorted->splice($offset, $num_per_page);

		return  new Paginator($sorted, count($array_of_objects), $num_per_page, $page );
	}
}
