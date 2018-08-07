<?php

namespace App\Observers;

use App\Models\News;

class NewsObserver
{
    public function deleting(News $item)
    {
        foreach ($item->comments as $comment) {
            $comment->delete();
        }
    }
}
