<?php
namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\JsonResponse;
use App\Models\ForumTheme;
use App\Models\User;
use Exception;

/**
 *
 */
class ForumThemesController extends AControllerBase
{
    public function index(): Response
    {

        $forumThemes = ForumTheme::getAll();
        return $this->html($forumThemes);
    }

    public function themes(): Response
    {
        return $this->html();
    }
}