<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Sentinel;
use URL;
use View;
use Yajra\DataTables\DataTables;
use App\Mail\Restore;
use App\Models\Country;

class UsersController extends JoshController
{
    protected $countries;

    public function __construct()
    {
        $this->countries = Country::all()->pluck('name', 'sortname')->toArray();
    }

    /**
     * Show a list of all the users.
     *
     * @return View
     */

    public function index()
    {

        // Show the page
        return view('users.index');
    }

    /*
     * Pass data through ajax call
     *
     * @return mixed
     */
    public function data()
    {
        $users = User::get(['id', 'first_name', 'last_name', 'email','created_at']);
        return DataTables::of($users)
            ->editColumn(
                'created_at',
                function (User $user) {
                    return $user->created_at->diffForHumans();
                }
            )
            ->addColumn(
                'status',
                function ($user) {

                    if ($activation = Activation::completed($user)) {
                        return 'Activated';
                    } else {
                                        return 'Pending';
                    }
                }
            )
            ->addColumn(
                'actions',
                function ($user) {
                    $actions = '<a href='. route('users.show', $user->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                            <a href='. route('users.edit', $user->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>';
                    if ((Sentinel::getUser()->id != $user->id) && ($user->id != 1)) {
                        $actions .= '<a href='. route('users.confirm-delete', $user->id) .' data-id="'.$user->id.'" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>';
                    }
                    return $actions;
                }
            )
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Create new user
     *
     * @return View
     */
    public function create()
    {

        // Get all the available roles
        $roles = Sentinel::getRoleRepository()->all();

        $countries = $this->countries;
        // Show the page
        //updating the newsItem will cause an activity being logged
        return view('users.create', compact('roles', 'countries'));
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(UserRequest $request)
    {
        //upload image
        if ($file = $request->file('pic_file')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/users/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['pic'] = $safeName;
        }
        //check whether use should be activated by default or not
        $activate = $request->get('activate') ? true : false;

        try {
            // Register the user
            $user = Sentinel::register($request->except('_token', 'password_confirm', 'role', 'activate', 'pic_file'), $activate);

            //add user to 'User' role
            $role = Sentinel::findRoleById($request->get('role'));
            if ($role) {
                $role->users()->attach($user);
            }
            //check for activation and send activation mail if not activated by default
            if (!$request->get('activate')) {
                // Data to be used on the email view
                $data =[
                    'user_name' => $user->first_name .' '. $user->last_name,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code])
                ];

                // Send the activation code through email
                Mail::to($user->email)
                    ->send(new Restore($data));
            }

            // Redirect to the home page with success menu
            return Redirect::route('users.index')->with('success', trans('users/message.success.create'));
        } catch (LoginRequiredException $e) {
            $error = trans('users/message.user_login_required');
        } catch (PasswordRequiredException $e) {
            $error = trans('users/message.user_password_required');
        } catch (UserExistsException $e) {
            $error = trans('users/message.user_exists');
        }

        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function edit(User $user)
    {

        // Get this user roles
        $userRoles = $user->getRoles()->pluck('name', 'id')->all();
        // Get a list of all the available roles
        $roles = Sentinel::getRoleRepository()->all();

        $status = Activation::completed($user);

        $countries = $this->countries;

        // Show the page
        return view('users.edit', compact('user', 'roles', 'userRoles', 'countries', 'status'));
    }

    /**
     * User update form processing page.
     *
     * @param  User        $user
     * @param  UserRequest $request
     * @return Redirect
     */
    public function update(User $user, UserRequest $request)
    {

        try {
            $user->update($request->except('pic_file', 'password', 'password_confirm', 'roles', 'activate'));

            if ($password = $request->has('password')) {
                $user->password = Hash::make($request->password);
            }

            // is new image uploaded?
            if ($file = $request->file('pic_file')) {
                $extension = $file->extension()?: 'png';
                $destinationPath = public_path() . '/uploads/users/';
                $safeName = str_random(10) . '.' . $extension;
                $file->move($destinationPath, $safeName);
                //delete old pic if exists
                if (File::exists($destinationPath . $user->pic)) {
                    File::delete($destinationPath . $user->pic);
                }
                //save new file path into db
                $user->pic = $safeName;
            }

            //save record
            $user->save();

            // Get the current user roles
            $userRoles = $user->roles()->pluck('id')->all();

            // Get the selected roles

            $selectedRoles = $request->get('roles');

            // roles comparison between the roles the user currently
            // have and the roles the user wish to have.
            $rolesToAdd = array_diff($selectedRoles, $userRoles);
            $rolesToRemove = array_diff($userRoles, $selectedRoles);

            // Assign the user to roles

            foreach ($rolesToAdd as $roleId) {
                $role = Sentinel::findRoleById($roleId);
                $role->users()->attach($user);
            }

            // Remove the user from roles
            foreach ($rolesToRemove as $roleId) {
                $role = Sentinel::findRoleById($roleId);
                $role->users()->detach($user);
            }

            // Activate / De-activate user

            $status = $activation = Activation::completed($user);

            if ($request->get('activate') != $status) {
                if ($request->get('activate')) {
                    $activation = Activation::exists($user);
                    if ($activation) {
                        Activation::complete($user, $activation->code);
                    }
                } else {
                    //remove existing activation record
                    Activation::remove($user);
                    //add new record
                    Activation::create($user);
                    //send activation mail
                    $data=[
                        'user_name' =>$user->first_name .' '. $user->last_name,
                        'activationUrl' => URL::route('activate', [$user->id, Activation::exists($user)->code])
                    ];
                    // Send the activation code through email
                    Mail::to($user->email)
                        ->send(new Restore($data));
                }
            }

            // Was the user updated?
            if ($user->save()) {
                // Prepare the success message
                $success = trans('users/message.success.update');

                //                 Redirect to the user page
                return Redirect::route('users.edit', $user)->with('success', $success);
            }

            // Prepare the error message
            $error = trans('users/message.error.update');
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('users.index')->with('error', $error);
        }

        // Redirect to the user page
        return Redirect::route('users.edit', $user)->withInput()->with('error', $error);
    }

    /**
     * Show a list of all the deleted users.
     *
     * @return View
     */
    public function getDeletedUsers()
    {
        // Grab deleted users
        $users = User::onlyTrashed()->get();
        // Show the page
        return view('deleted_users', compact('users'));
    }


    /**
     * Delete Confirm
     *
     * @param  int $id
     * @return View
     */
    public function getModalDelete($id)
    {
        $model = 'users';
        $confirm_route = $error = null;
        try {
            // Get user information
            $user = Sentinel::findById($id);

            // Check if we are not trying to delete ourselves
            if ($user->id === Sentinel::getUser()->id) {
                // Prepare the error message
                $error = trans('users/message.error.delete');

                return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
            }
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        $confirm_route = route('users.delete', ['id' => $user->id]);
        return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {

        try {
            // Get user information
            $user = Sentinel::findById($id);
            // Check if we are not trying to delete ourselves
            if ($user->id === Sentinel::getUser()->id) {
                // Prepare the error message
                $error = trans('users/message.error.delete');
                // Redirect to the user management page
                return Redirect::route('users.index')->with('error', $error);
            }
            // Delete the user
            //to allow soft deleted, we are performing query on users model instead of Sentinel model
            User::destroy($id);
            // Prepare the success message
            $success = trans('users/message.success.delete');

            // Redirect to the user management page
            return Redirect::route('users.index')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('users.index')->with('error', $error);
        }
    }

    /**
     * Restore a deleted user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getRestore($id)
    {

        try {
            // Get user information
            $user = User::withTrashed()->find($id);
            // Restore the user
            $user->restore();
            // create activation record for user and send mail with activation link
            $data=[
                'user_name' => $user->first_name .' '. $user->last_name,
                'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code])
            ];
            // Send the activation code through email
            Mail::to($user->email)
                ->send(new Restore($data));
            // Prepare the success message
            $success = trans('users/message.success.restored');
            // Redirect to the user management page
            return Redirect::route('deleted_users')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('deleted_users')->with('error', $error);
        }
    }

    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            // Get the user information
            $user = Sentinel::findUserById($id);
            //get country name
            if ($user->country) {
                $user->country = $this->countries[$user->country];
            }
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));
            // Redirect to the user management page
            return Redirect::route('users.index')->with('error', $error);
        }
        // Show the page
        return view('users.show', compact('user'));
    }

    public function passwordreset($id, Request $request)
    {
        $user = Sentinel::findUserById($id);
        $password = $request->get('password');
        $user->password = Hash::make($password);
        $user->save();
    }

    public function lockscreen($id)
    {
        $user = Sentinel::findUserById($id);
        return view('lockscreen', compact('user'));
    }

    public function postLockscreen(Request $request)
    {
        $password = Sentinel::getUser()->password;
        if (Hash::check($request->password, $password)) {
            return 'success';
        } else {
            return 'error';
        }
    }
}
