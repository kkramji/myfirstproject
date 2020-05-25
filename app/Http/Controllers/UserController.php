<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'name' => 'Elon',
            'email' => 'elon@thisworld4u.com',
            'password' => 'password',
        ];
        //  User::Create($data);
        // $user  = new User();
        // $user->name = 'testname';
        // $user->email = 'testname@gmail.com';
        // $user->password = bcrypt('testname');
        // $user->save();
        // User::where('id', 2)->delete();
        // User::where('id', 3)->update(['name' => 'testupdatename']);
        $user = User::all();
        return $user;
        //   DB::insert('insert into users (name, email, password) values (?,?,?)', ['testuser','testusermail@gmail.com','password',]);
        // DB::update('update users set name= ? where id = 1', ['testupdate']);

        // DB::delete('delete from users where id=1');


        // $users = DB::select('select * from users');
        // return $users;
        return view('home');
    }
}
