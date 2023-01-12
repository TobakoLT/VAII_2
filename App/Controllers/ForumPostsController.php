<?php
namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\JsonResponse;
use App\Models\ForumTheme;
use App\Models\ForumPost;
use Exception;

/**
 *
 */
class ForumPostsController extends AControllerBase
{
    public function index(): Response
    {

        $forumPosts = ForumPost::getAll();
        return $this->html($forumPosts);
    }

    public function posts(): Response
    {
        return $this->html();
    }
}