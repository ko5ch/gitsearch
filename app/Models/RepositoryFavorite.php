<?php

namespace App\Models;

use App\Services\Api\GitService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RepositoryFavorite
 * @package App\Models
 * @property string name
 * @property string html_url
 * @property string description
 * @property string owner_login
 * @property int stargazers_count
 * @property int id
 * @property int repo_id
 */
class RepositoryFavorite extends Model
{
    use HasFactory;

    const STORE_UNIQUE_FIELD = ['repo_id'];
    const DEFAULT_PAGINATION = 5;

    protected $fillable = ['name', 'html_url', 'description', 'owner_login', 'stargazers_count', 'repo_id'];

    public function getOwnerLoginLinkAttribute()
    {
        return \Str::of($this->owner_login)->start(GitService::GIT_URL)->__toString();
    }

    public function getHtmlUrlLinkAttribute()
    {
        return \Str::start($this->html_url, GitService::GIT_URL);
    }
}
