 @if($todo->completed)
 <span onclick="event.preventDefault();document.getElementById('form-incomplete-{{$todo->id}}').submit()"
     class="fas text-green-300 fa-check px-2 cursor-pointer" />
 <form id="{{'form-incomplete-'.$todo->id}}" style="display:none" method="post"
     action="{{route('todo.incomplete', $todo->id)}}">
     @csrf
     @method('delete')
 </form>

 @else
 <span onclick="event.preventDefault();document.getElementById('form-complete-{{$todo->id}}').submit()"
     class="fas text-gray-300 fa-check px-2 cursor-pointer" />
 <form id="{{'form-complete-'.$todo->id}}" style="display:none" method="post"
     action="{{route('todo.complete', $todo->id)}}">
     @csrf
     @method('put')
 </form>
 @endif