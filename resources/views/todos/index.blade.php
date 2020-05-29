@extends('todos.layouts')
@section('content')
<div class="flex justify-between border-b pb-4 px-4 ">
    <h1 class="text-2xl">All Todos </h1>
    <a href="{{route('todo.create')}}" class="mx-5  py-2  text-blue-300 cursor-pointer   text-white">
        <span class="fas fa-plus-circle  "></span>
    </a>
</div>

<ul class="my-5 ">
    <x-alert />
    @forelse($todos as $todo)
    <li class="flex justify-between p-2">
        <div>
            @include('todos.complete-button')
        </div>
        @if($todo->completed)
        <p class="line-through">{{$todo->title}}</p>
        @else
        <p>
            <a class="cursor-pointer" href="{{ route('todo.show',$todo->id) }}"> {{$todo->title}} </a>
        </p>
        @endif
        <div>
            <a href="{{ route('todo.edit',$todo->id) }}"
                class="mx-5 py-1 px-1 text-orange-300 cursor-pointer  text-white"> <span
                    class="fas fa-edit  px-2" /></a>


            <span onclick="event.preventDefault();
            if(confirm('Are you sure want to delete?') ){
            document.getElementById('form-delete-{{$todo->id}}').submit()
            } 
            " class="fas fa-trash text-red-500  px-2 cursor-pointer" />
            <form id="{{'form-delete-'.$todo->id}}" style="display:none" method="post"
                action="{{route('todo.destroy', $todo->id)}}">
                @csrf
                @method('delete ')
            </form>
        </div>
    </li>
    @empty
    <p> No task available, create one</p>
    @endforelse
</ul>
@endsection