@extends('todos.layouts')
@section('content')
<h1 class="text-2xl">What Next To Do </h1>
<x-alert />
<form enctype="multipart/form-data" action="{{route('todo.store')}}" method="post" class="py-5 ">
    @csrf
    <div class="py-1">
        <input type="file" name="todopic">
    </div>
    <div class="py-1">
        <input type="text" name="title" class="py-2 px-2 border rounded " placeholder="Title">
    </div>
    <div class="py-1">
        <textarea name="description" class="p-2 border rounded" placeholder="Description"></textarea>
    </div>
    <div class="py-1">
        @livewire('step')
    </div>
    <div class="py-1">
        <input type="submit" value="Create" class="p-2 border rounded">
    </div>
</form>

<a href="{{route('todo.index')}}" class="m-5 py-1 px-1 bg-blue-400 cursor-pointer rounded text-black border">Back</a>

@endsection