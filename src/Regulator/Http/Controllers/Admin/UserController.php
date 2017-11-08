<?php

namespace Jameron\Regulator\Http\Controllers\Admin;

use DB;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Jameron\Regulator\Models\Role;
use App\Http\Controllers\Controller;
use Jameron\Enrollments\Models\Company;
use Jameron\Regulator\Http\Requests\UserRequest;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request->get('search')) ? $request->get('search') : null;
        $sort_by = ($request->get('sortBy')) ? $request->get('sortBy') : 'email';
        $order = ($request->get('order')) ? $request->get('order') : 'ASC';

        // new
        if (! $search) {
            switch ($sort_by) {

            case 'email':

                $users = User::select('users.*')
                                    ->with('roles')
                                    ->orderBy('users.email', $order)
                                    ->paginate(20);

                if (config('session.driver') == 'database') {
                    $online_users = DB::table('sessions')
                                            ->where('last_activity', '>', time() - 60)
                                            ->join('users', 'users.id', '=', 'sessions.user_id')
                                            ->pluck('last_activity', 'user_id');

                    $user_ids = array_keys($online_users->toArray());

                    foreach ($users as $user) {
                        if (array_key_exists($user->id, $online_users->toArray())) {
                            $user->online = 'yes';
                            $user->last_active = Carbon::createFromTimeStamp($online_users[$user->id], 'America/Los_Angeles')->format('F j, Y g:i:s a');
                        } else {
                            $user->online = 'no';
                        }
                    }
                }

                    break;

                case 'role':


                    $users = User::join('regulator_role_user', 'regulator_role_user.user_id', '=', 'users.id')
                                    ->join('regulator_roles', 'regulator_roles.id', '=', 'regulator_role_user.role_id')
                                    ->orderBy('regulator_roles.name', $order)
                                    ->with('roles')
                                    ->select('users.id', 'users.email', 'users.name', 'users.last_login', 'regulator_roles.name as role_name')
                                    ->distinct()
                                    ->paginate(20);

                    if (config('session.driver') == 'database') {
                        $online_users = DB::table('sessions')
                                            ->where('last_activity', '>', time() - 60)
                                            ->join('users', 'users.id', '=', 'sessions.user_id')
                                            ->pluck('last_activity', 'user_id');

                        $user_ids = array_keys($online_users->toArray());

                        foreach ($users as $user) {
                            if (array_key_exists($user->id, $online_users->toArray())) {
                                $user->online = 'yes';
                                $user->last_active = Carbon::createFromTimeStamp($online_users[$user->id], 'America/Los_Angeles')->format('F j, Y g:i:s a');
                            } else {
                                $user->online = 'no';
                            }
                        }
                    }

                    break;

                case 'name':

                    $users = User::select('users.*')
                                    ->with('roles')
                                    ->orderBy('users.name', $order)
                                    ->paginate(20);

                    if (config('session.driver') == 'database') {
                        $online_users = DB::table('sessions')
                                            ->where('last_activity', '>', time() - 60)
                                            ->join('users', 'users.id', '=', 'sessions.user_id')
                                            ->pluck('last_activity', 'user_id');

                        $user_ids = array_keys($online_users->toArray());

                        foreach ($users as $user) {
                            if (array_key_exists($user->id, $online_users->toArray())) {
                                $user->online = 'yes';
                                $user->last_active = Carbon::createFromTimeStamp($online_users[$user->id], 'America/Los_Angeles')->format('F j, Y g:i:s a');
                            } else {
                                $user->online = 'no';
                            }
                        }
                    }

                    break;

                case 'email':

                    $users = User::select('users.*')
                                    ->with('roles')
                                    ->orderBy('users.email', $order)
                                    ->paginate(20);

                    if (config('session.driver') == 'database') {
                        $online_users = DB::table('sessions')
                                            ->where('last_activity', '>', time() - 60)
                                            ->join('users', 'users.id', '=', 'sessions.user_id')
                                            ->pluck('last_activity', 'user_id');

                        $user_ids = array_keys($online_users->toArray());

                        foreach ($users as $user) {
                            if (array_key_exists($user->id, $online_users->toArray())) {
                                $user->online = 'yes';
                                $user->last_active = Carbon::createFromTimeStamp($online_users[$user->id], 'America/Los_Angeles')->format('F j, Y g:i:s a');
                            } else {
                                $user->online = 'no';
                            }
                        }
                    }

                    break;

                case 'internal_id':

                    $online_users = DB::table('sessions')
                                            ->where('last_activity', '>', time() - 60)
                                            ->join('users', 'users.id', '=', 'sessions.user_id')
                                            ->pluck('last_activity', 'user_id');

                    if (config('session.driver') == 'database') {
                        $user_ids = array_keys($online_users->toArray());
                        $users = User::select('users.*')
                                        ->with('roles')
                                        ->orderBy('users.internal_id', $order)
                                        ->paginate(20);

                        foreach ($users as $user) {
                            if (array_key_exists($user->id, $online_users->toArray())) {
                                $user->online = 'yes';
                                $user->last_active = Carbon::createFromTimeStamp($online_users[$user->id], 'America/Los_Angeles')
                                    ->format('F j, Y g:i:s a');
                            } else {
                                $user->online = 'no';
                            }
                        }
                    }

                    break;

                case 'online':

                    if (config('session.driver') == 'database') {
                        $online_users = DB::table('sessions')
                                                ->where('last_activity', '>', time() - 60)
                                                ->join('users', 'users.id', '=', 'sessions.user_id')
                                                ->pluck('last_activity', 'user_id')
                                                ;

                        $user_ids = array_keys($online_users->toArray());
                        
                        $users = User::select('users.*')
                            ->with('roles')
                            ->get();

                                    //	->paginate(20);

                        foreach ($users as $user) {
                            if (array_key_exists($user->id, $online_users->toArray())) {
                                $user->online = 'yes';
                                $user->last_active = Carbon::createFromTimeStamp($online_users[$user->id], 'America/Los_Angeles')->format('F j, Y g:i:s a');
                            } else {
                                $user->online = 'no';
                            }
                        }

                        $page = $request->get('page');
                        $users = $this->sortBy($users, 'online', $order, $page);
                    }

                    break;

                case 'last_login':

                    $online_users = DB::table('sessions')
                                            ->where('last_activity', '>', time() - 60)
                                            ->join('users', 'users.id', '=', 'sessions.user_id')
                                            ->pluck('last_activity', 'user_id');

                    $user_ids = array_keys($online_users->toArray());

                    $users = User::select('users.*')
                        ->with('roles')
                        ->orderBy('users.last_login', $order)
                        ->paginate(20);

                    foreach ($users as $user) {
                        if (array_key_exists($user->id, $online_users->toArray())) {
                            $user->online = 'yes';
                            $user->last_active = Carbon::createFromTimeStamp($online_users[$user->id], 'America/Los_Angeles')->format('F j, Y g:i:s a');
                        } else {
                            $user->online = 'no';
                        }
                    }

                    break;

                case 'enabled':

                    $online_users = DB::table('sessions')
                                            ->where('last_activity', '>', time() - 300)
                                            ->join('users', 'users.id', '=', 'sessions.user_id')
                                            ->pluck('last_activity', 'user_id');

                    $user_ids = array_keys($online_users->toArray());

                    $users = User::select('users.*')
                                    ->with('roles')
                                    ->orderBy('users.disabled', $order)
                                    ->paginate(20);

                    foreach ($users as $user) {
                        if (array_key_exists($user->id, $online_users->toArray())) {
                            $user->online = 'yes';
                            $user->last_active = Carbon::createFromTimeStamp($online_users[$user->id], 'America/Los_Angeles')->format('F j, Y g:i:s a');
                        } else {
                            $user->online = 'no';
                        }
                    }

                    break;
            }
        } elseif ($search) {
            $users = User::select('users.*')
                            ->with('roles')
                            ->where(function ($query) use ($search) {
                                $query->where('users.email', 'LIKE', '%'.$search.'%')
                      ->orwhere('users.internal_id', 'LIKE', '%'.$search.'%');
                            })->paginate(20);

            $online_users = DB::table('sessions')
                                    ->where('last_activity', '>', time() - 300)
                                    ->join('users', 'users.id', '=', 'sessions.user_id')
                                    ->pluck('last_activity', 'user_id');

            $user_ids = array_keys($online_users->toArray());

            foreach ($users as $user) {
                if (array_key_exists($user->id, $online_users->toArray())) {
                    $user->online = 'yes';
                    $user->last_active = Carbon::createFromTimeStamp($online_users[$user->id], 'America/Los_Angeles')->format('F j, Y g:i:s a');
                } else {
                    $user->online = 'no';
                }
            }
        } else {
            $online_users = DB::table('sessions')
                                    ->where('last_activity', '>', time() - 300)
                                    ->join('users', 'users.id', '=', 'sessions.user_id')
                                    ->pluck('last_activity', 'user_id');

            $user_ids = array_keys($online_users->toArray());

            $users = User::select('users.*')
                            ->with('roles')
                            ->paginate(20);

            foreach ($users as $user) {
                if (array_key_exists($user->id, $online_users)) {
                    $user->online = 'Yes';
                    $user->last_active = Carbon::createFromTimeStamp($online_users[$user->id], 'America/Los_Angeles')->format('F j, Y g:i:s a');
                } else {
                    $user->online = 'No';
                }
            }
        }
        return view('regulator::admin.users.index', compact('users', 'search', 'sort_by', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = null;
        $roles = Role::all();

        if (config('enrollments.options.has_companies')) {
            $companies = Company::pluck('name', 'id');
            $companies->prepend('Select a company', '');
        }


        return view('regulator::admin.users.create', compact('companies', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->get('company_id')) {
            $user->company_id = $request->get('company_id');
        }

        $user->password = bcrypt($request->get('password'));

        $user->save();

        $request->roles = ($request->get('roles')) ? $request->get('roles') : [];
        $user->roles()->sync($request->roles);

        return redirect('/admin/users')
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
        $user = User::where('id', $id)
            ->with('roles')
            ->first();

        $companies = null;
        if (config('enrollments.options.has_companies')) {
            $companies = Company::pluck('name', 'id');
            $companies->prepend('Select a company', '');
        }
        $roles = Role::all();

        return view('regulator::admin.users.edit', compact('companies', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::where('id', $id)
            ->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if (!empty($request->get('password'))) {
            $user->password = bcrypt($request->get('password'));
        }
        if ($request->get('company_id')) {
            $user->company_id = $request->get('company_id');
        }
        $user->save();

        $request->roles = ($request->get('roles')) ? $request->get('roles') : [];
        $user->roles()->sync($request->roles);

        return redirect('/admin/users')
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
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect('admin/users')->with('success_message', 'User was deleted.');
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
