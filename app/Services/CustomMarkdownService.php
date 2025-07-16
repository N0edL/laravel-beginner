<?php

namespace App\Services;

use App\Models\User;
use App\Models\Project;
use Carbon\Carbon;

class CustomMarkdownService
{
    /**
     * Process custom markdown syntax in text
     */
    public function process(string $text): string
    {
        // Process age tags: <age:name>
        $text = $this->processAgeTags($text);

        // Process other custom tags
        $text = $this->processTotalActiveProjects($text);

        // Process basic markdown formatting
        $text = $this->processBasicMarkdown($text);

        return $text;
    }

    /**
     * Process age tags and replace with calculated age
     */
    private function processAgeTags(string $text): string
    {
        // Pattern to match <age:name>
        $pattern = '/<age:([^>]+)>/';

        return preg_replace_callback($pattern, function ($matches) {
            $name = trim($matches[1]);

            // Find user by name
            $user = User::where('name', $name)->first();

            if (!$user || !$user->dob) {
                return '<span class="text-red-500">[Age not available]</span>';
            }

            // Calculate age
            $age = Carbon::parse($user->dob)->age;

            return $age;
        }, $text);
    }

    /**
     * Process basic markdown formatting
     */
    private function processBasicMarkdown(string $text): string
    {
        // Process line breaks first
        $text = $this->processLineBreaks($text);

        // Process bold text: **text** or __text__
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        $text = preg_replace('/__(.*?)__/', '<strong>$1</strong>', $text);

        // Process italic text: *text* or _text_
        $text = preg_replace('/(?<!\*)\*(?!\*)([^*]+)\*(?!\*)/', '<em>$1</em>', $text);
        $text = preg_replace('/(?<!_)_(?!_)([^_]+)_(?!_)/', '<em>$1</em>', $text);

        // Process underline: ++text++
        $text = preg_replace('/\+\+(.*?)\+\+/', '<u>$1</u>', $text);

        // Process strikethrough: ~~text~~
        $text = preg_replace('/~~(.*?)~~/', '<del>$1</del>', $text);

        // Process inline code: `code`
        $text = preg_replace('/`(.*?)`/', '<code class="px-1 py-0.5 bg-gray-200 dark:bg-gray-700 rounded text-sm">$1</code>', $text);

        return $text;
    }

    /**
     * Process line breaks and paragraph formatting
     */
    private function processLineBreaks(string $text): string
    {
        // Convert /n to actual line breaks
        $text = str_replace('/n', "\n", $text);

        // Convert \n to actual line breaks (if escaped)
        $text = str_replace('\\n', "\n", $text);

        // Convert double line breaks to paragraphs
        $text = preg_replace('/\n\s*\n/', '</p><p>', $text);

        // Wrap in paragraph tags if we have paragraph breaks
        if (strpos($text, '</p><p>') !== false) {
            $text = '<p>' . $text . '</p>';
        }

        // Convert single line breaks to <br> tags
        $text = str_replace("\n", '<br>', $text);

        return $text;
    }

    /**
     * You can add more custom markdown processors here
    */
    private function processTotalActiveProjects(string $text): string
    {
        // Pattern to match <tap>
        $pattern = '/<tap>/';

        return preg_replace_callback($pattern, function () {

            $totalActiveProjects = Project::where('active', true)->count();

            return $totalActiveProjects;
        }, $text);
    }
}
