<?php

namespace App\Models;

use App\Models\Traits\ModelBlamer;
use App\Models\Traits\MyLogsActivity;
use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ModelBlamer;
    use Sluggable;
    use MyLogsActivity;

    protected $guarded = [];

    public function parent(): ?BelongsTo {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    public function childs(): ?HasMany {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }

    public function posts(): HasMany {
        return $this->hasMany(BlogPost::class, 'category_id');
    }

    public function getThumbnailUrlAttribute(): String {
        return asset('storage/'.$this->thumbnail);
    }

    public function getChilds($limit = 5): Collection {
        return BlogCategory::where(['is_published' => 1, 'parent_id' => $this->id])
            ->orderBy('created_at', 'DESC')
            ->take($limit)
            ->get();
    }

    public function getPosts($limit = 5): Collection {
        return BlogPost::where(['is_published' => 1, 'category_id' => $this->id])
            ->orderBy('created_at', 'DESC')
            ->take($limit)
            ->get();
    }

    public function getUrlAttribute(): String {
        return route('blog.viewCategory', ['slug' => $this->slug]);
    }

}
