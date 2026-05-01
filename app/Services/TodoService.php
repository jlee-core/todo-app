<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TodoCreatedNotification;
use Illuminate\Notifications\Notifiable;

class TodoService
{
    public function create(array $data, ?UploadedFile $attachment = null): Todo
    {
        $attachmentPath = null;

        if ($attachment) {
            $attachmentPath = $attachment->store('todos', 'public');
        }

        $todo = Todo::create([
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'attachment_path' => $attachmentPath,
            'is_done' => false,
            'user_id' => Auth::id(),
        ]);
        
        Auth::user()?->notify(new TodoCreatedNotification());

        return $todo;
    }
}
