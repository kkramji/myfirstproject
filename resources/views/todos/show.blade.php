@extends('todos.layouts')
@section('content')
<div class="flex justify-between border-b pb-4 px-4 ">
    <h1 class="text-2xl">{{$todo->title}} </h1>
    <div><a href="{{route('todo.index')}}"
            class="m-5 py-1 px-1 bg-blue-400 cursor-pointer rounded text-black border">Back</a></div>
</div>
<div>
    <p>{{$todo->description}}</p>
</div>
<div>
    <h3>Steps for this Task</h3>
    @if($todo->steps->count() >0)
    @foreach($todo->steps as $step)
    <p>{{$step->name}}</p>
    @endforeach
    @endif
</div>

</div>
@endsection