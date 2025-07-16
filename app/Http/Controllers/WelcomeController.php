<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\AboutMe;
use App\Services\CustomMarkdownService;

class WelcomeController extends Controller
{
    protected $markdownService;

    public function __construct(CustomMarkdownService $markdownService)
    {
        $this->markdownService = $markdownService;
    }

    public function index()
    {
        $Projects = Project::all();
        $aboutMe = AboutMe::first();

        // Process custom markdown if aboutMe exists
        if ($aboutMe) {
            $aboutMe->processed_text = $this->markdownService->process($aboutMe->text);
        }

        return view('welcome', compact('Projects', 'aboutMe'));
    }
}
