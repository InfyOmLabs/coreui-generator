<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Queries\UserDataTable;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Auth;
use DataTables;
use Exception;
use Flash;
use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Redirect;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    /** @var RoleRepository $roleRepo */
    private $roleRepo;

    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo)
    {
        $this->userRepository = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param  Request  $request
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new UserDataTable())->get())->make(true);
        }
        $roles = $this->roleRepo->getRolesList();

        return view('users.index', compact('roles'));
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleRepo->getRolesList();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  CreateUserRequest  $request
     *
     * @throws Exception
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $input = $request->all();

            $this->userRepository->store($input);

            Flash::success('User saved successfully.');

            return redirect(route('users.index'));
        } catch (Exception $e) {
            return Redirect::back()->withInput()->withErrors($e->getMessage());
        }
    }


    /**
     * Display the specified User.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('User', $user);
    }


    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function edit($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            return $this->sendError('User not found.');
        }
        $roles = $this->roleRepo->getRolesList();

        return view('users.edit',compact('user','roles'));
    }

    /**
     * @param  User  $user
     * @param  UpdateUserRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        try {
            $input = $request->all();

            $this->userRepository->update($user->id, $input);
            Flash::success('User updated successfully.');

            return redirect(route('users.index'));
        } catch (Exception $e) {
            return Redirect::back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  User  $user
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->sendSuccess('User deleted successfully.');
    }

    /**
     * @param UpdateUserProfileRequest $request
     *
     * @return JsonResponse
     */
    public function profileUpdate(UpdateUserProfileRequest $request)
    {
        $input = $request->all();

        $this->userRepository->profileUpdate($input);

        return $this->sendSuccess('Profile updated successfully.');
    }

    /**
     * @param ChangePasswordRequest $request
     *
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($input['password_current'], $user->password)) {
            return $this->sendError('Current password is invalid.');
        }

        $input['password'] = Hash::make($input['password']);
        $user->update($input);

        return $this->sendSuccess('Password updated successfully.');
    }

}
