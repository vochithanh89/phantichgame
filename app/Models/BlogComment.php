<?php

namespace App\Models;

use App\Models\Traits\MyLogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;
    use MyLogsActivity;
}
