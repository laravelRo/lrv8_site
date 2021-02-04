<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\File;




class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function showUsers()
    {
        $users = User::all()->sortBy('name');
        return view('admin.users')->with('users', $users);
    }

    public function newUser()
    {
        return view('admin.users-new');
    }

    public function createUser(CreateUserRequest $request)
    {

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);

        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoName = str_replace(' ', '', $request->name) . '_' . time() . '.' . $extension;

            $request->file('photo')->move('images/users', $photoName);

            $user->photo = $photoName;
        }
        $mess = 'Utilizatorul ' . $request->name . ' a fost inregistrat in baza de date. Emailul utilizatorului nu este validat!';

        if ($request->verified == 1) {
            $user->email_verified_at = now();
            $mess = 'Utilizatorul ' . $request->name . ' a fost inregistrat in baza de date. Emailul utilizatorului este validat!';
        }

        $user->save();

        return redirect(route('users'))->with('success', $mess);
    }

    function showEditForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users-edit')->with('user', $user);
    }

    function updateUser(UpdateUserRequest $request, $id)
    {
        $this->validate(
            $request,
            [
                'email' => 'unique:users,email,' . $id
            ],
            [
                'email.unique' => 'Acest email este deja inregistrat in baza de date'
            ]
        );
        $user = User::findOrFail($id);

        if ($request->hasFile('photo')) {

            if (!($user->photo == 'default.jpg')) {
                File::delete('images/users/' . $user->photo);
            }

            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoName = str_replace(' ', '', $request->name) . '_' . time() . '.' . $extension;

            $request->file('photo')->move('images/users', $photoName);

            $user->photo = $photoName;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;

        $mess = 'Datele utilizatorului au fost actualizate!';

        //verificare email
        if ($request->verified == 'mark') {
            $user->email_verified_at = now();
            $mess = "Datele utilizatorului au fost actualizate si emailul a fost validat cu succes ";
        }
        if ($request->verified == 'invalid') {
            $user->email_verified_at = null;
            $mess = "Datele utilizatorului au fost actualizate si emailul a fost invalidat!";
        }
        if ($request->verified == 'send') {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
            $mess = "Datele utilizatorului au fost actualizate, emailul a fost invalidat si a fost trimisa o notificare prin email!";
        }



        $user->save();
        return redirect(route('users'))->with('success', $mess);
    }



    function deleteUser(Request $request, $id)
    {


        $user = User::findOrFail($id);

        if ($user->role == "admin") {
            return redirect(route('users'));
        }

        if (!($user->photo == 'default.jpg')) {
            File::delete('images/users/' . $user->photo);
        }

        $user->delete();
        return redirect(route('users'))->with('success', 'Utilizatorul ' . $user->name . ' a fost sters definitiv din baza de date');
    }
}
