<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Step;


use Illuminate\Http\Request;
use App\Http\Requests\TodoCreateRequest;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except('index');
        // $this->middleware('auth')->only('index');
        $this->middleware('auth');
    }
    public function index()
    {
        $todos =  auth()->user()->todos->sortBy('completed');
        // $todos =  auth()->user()->todos()->orderby('completed')->get();
        // $todos = Todo::orderby('completed', 'desc')->get();
        // $todos = Todo::all();
        // return view('todos.index')->with(['todos' => $todos]);
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }
    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }
    public function update(TodoCreateRequest $request, Todo $todo)
    {
        $todo->update(['title' => $request->title,'description' => $request->description]);
        if ($request->stepName) {
            foreach ($request->stepName as $key => $value) {
                $id = $request->stepId[$key];
                if (!$id) {
                    $todo->steps()->create(['name'=>$value]);
                } else {
                    $step = Step::find($id);
                    $step->update(['name' => $value]);
                }
            }
            return redirect(route('todo.index'))->with('message', 'Updated!');
        }
    }
    public function complete(Todo $todo)
    {
        $todo->update(['completed' => true]);
        return redirect()->back()->with('message', 'Task Completed');
    }
    public function destroy(Todo $todo)
    {
        $todo->steps->each->delete();
        $todo->delete();
        return redirect()->back()->with('message', 'Task Deleted');
    }
    public function incomplete(Todo $todo)
    {
        $todo->update(['completed' => false]);
        return redirect()->back()->with('message', 'Task InCompleted');
    }
     
    public function store(TodoCreateRequest $request)
    {
        // dd($request->hasFile('todopic'));
        // $request->validate([
        //    'title' => 'required|max:255',
        // ]);
        // $rules = [
        //    'title' => 'required|max:255',
        // ];
        // $messages =[
        //     'title.max' => 'Todo title not greater than 255 baby',
        // ];

        // $validator = Validator::make($request->all(), $rules, $messages);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // dd(auth()->user()->todos());

    
        $todo =  auth()->user()->todos()->create($request->all());
        if ($request->hasFile('todopic')) {
            $filename = $request->todopic->getClientOriginalName();
            $request->todopic->storeAs('todo_images', $filename, 'public');
            $request->todopic = $filename;
            $todo->update(['todopic' => $filename]);
            //  Todo::uploadAvatar($request->todoimage);
        }
        if ($request->step) {
            foreach ($request->step as $step) {
                $todo->steps()->create(['name' => $step]);
            }
        }
        // Todo::create($request->all());
        return redirect(route('todo.index'))->with('message', 'Todo Created Successfully');
    }
}
