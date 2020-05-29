@extends('todos.layouts')
@section('content')
<h1 class="text-2xl">Update this todo list </h1>
<x-alert />
<form action="{{route('todo.update',$todo->id)}}" method="post" class="py-5 ">
    @csrf
    @method('patch')
    <div class="py-1">
        <input type="text" name="title" value="{{$todo->title}}" class="py-2 px-2 border rounded " placeholder="Title">
    </div>
    <div class="py-1">
        <textarea name="description" class="p-2 border rounded"
            placeholder="Description">{{$todo->description}}</textarea>
    </div>
    <div class="py-2">
        @livewire('edit-step',['steps' =>$todo->steps])
    </div>
    <div class="py-1">
        <input type="submit" value="Update" class="p-2 border rounded">
    </div>




</form>
<a href="{{route('todo.index')}}" class="m-5 py-1 px-1 bg-blue-400 cursor-pointer rounded text-black border">Back</a>
@endsection