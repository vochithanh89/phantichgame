<?php

namespace App\Models;

use App\Models\Traits\ModelBlamer;
use App\Models\Traits\MyLogsActivity;
use App\Models\Traits\Sluggable;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Date\Date;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Tags\HasTags;
use Illuminate\Support\Str;

class BlogPost extends Model implements Feedable
{
    use HasFactory;
    use SoftDeletes;
    use HasTags;
    use ModelBlamer;
    use Sluggable;
    use MyLogsActivity;

    protected $guarded = [];

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->name)
            ->summary($this->description)
            ->updated($this->updated_at)
            ->link($this->url)
            ->authorName($this->author->name)
            ->authorEmail($this->author->email);
    }

    public function getAllFeedItems(): Collection {
        return BlogPost::where(['is_published' => 1])
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function category(): BelongsTo {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function comments(): HasMany {
        return $this->hasMany(BlogComment::class, 'post_id');
    }

    public function tags(): MorphToMany {
        return $this
            ->morphToMany(Tag::class, 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('view_count');
    }

    public function getCreatedAtStringAttribute(): String {
        $date = new Date($this->created_at);
        return $date->format('D, d/m/Y');
    }

    public function getUrlAttribute(): String {
        return route('blog.viewPost', ['category_slug' => $this->category->slug, 'slug' => $this->slug]);
    }

    public function getThumbnailUrlAttribute(): String {
        return asset('storage/'.$this->thumbnail);
    }

    public function getReadTimeAttribute(): CarbonInterval
    {
        $wordCount = Str::wordCount($this->content);
        $timeToRead = $wordCount / (200 / CarbonInterval::getSecondsPerMinute());

        return CarbonInterval::createFromFormat('i.u', strval($timeToRead / 60));
    }

    public function getRelatedPostsAttribute(): Collection {
        return BlogPost::where(['is_published' => 1, 'category_id' => $this->category_id])
            ->where('id', '!=', $this->id)
            ->inRandomOrder()
            ->take(12)
            ->get();
    }

    public function getRecommendPostsAttribute(): Collection {
        return BlogPost::where(['is_published' => 1])
            ->where('id', '!=', $this->id)
            ->inRandomOrder()
            ->take(12)
            ->get();
    }

    public static function getPopularPosts($limit = 5): Collection {
        return BlogPost::where(['is_published' => 1])
            ->orderBy('is_trending', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->take($limit)
            ->get();
    }

    public static function getPopularMonthPosts($limit = 5): Collection {
        return BlogPost::where(['is_published' => 1])
            ->whereMonth('created_at', Carbon::now()->month)
            ->orderBy('is_trending', 'DESC')
            ->orderBy('view_count', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->take($limit)
            ->get();
    }

    public static function getPriorityPosts($limit = 5): Collection {
        return BlogPost::where(['is_published' => 1])
            ->orderBy('is_priority', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->take($limit)
            ->get();
    }

    public static function getNewestPosts($limit = 5): Collection {
        return BlogPost::where(['is_published' => 1])
            ->orderBy('created_at', 'DESC')
            ->take($limit)
            ->get();
    }
}
