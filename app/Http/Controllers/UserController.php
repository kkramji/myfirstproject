<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('image')) {
            //     $filename = $request->image->getClientOriginalName();
            //    $this->deleteOldImage();
            //     $request->image->storeAs('images', $filename, 'public');
            //     auth()->user()->update(['avatar' => $filename]);
            // User::find(1)->update(['avatar' => $filename]);\
            // session()->put('message', 'Image Uploaded');
            User::uploadAvatar($request->image);
            // $request->session()->flash('message', 'Image Uploaded');
            return redirect()->back()->with('message', 'Upload successfully');
        }
        // $request->image->store('images', 'public');
        // $request->session()->flash('error', 'Image Not Uploaded');
        // return redirect()->back();
        return redirect()->back()->with('error', 'Upload Not successfully');
    }
  
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
        // return redirect(route('todo.index'));
    }
}
