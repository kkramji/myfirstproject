<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Step;

class Todo extends Model
{
    protected $fillable = ['title','completed','user_id','description','todopic'];

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public static function uploadAvatar($image)
    {
        $filename = $image->getClientOriginalName();
        (new self())->deleteOldImage();
        $image->storeAs('todo_images', $filename, 'public');
        auth()->user()->update(['todopic' => $filename]);
    }

    protected function deleteOldImage()
    {
        if ($this->todopic) {
            Storage::delete('/public/todo_images/'.$this->todopic);
        }
    }
}
