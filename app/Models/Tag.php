<?php

namespace App\Models;

use App\Models\Traits\MyLogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\Tag as SpatieTag;

class Tag extends SpatieTag
{
    use HasFactory;
    use MyLogsActivity;

    public function getUrlAttribute(): String {
        return route('blog.viewTag', ['slug' => $this->slug]);
    }
}
