<?php

namespace App\Models;

use App\NewsApiRequest;

class Article
{

    private string $title;
    private string $url;
    private string $content;
    private ?string $imageUrl;
    private ?string $publishedAt;

    public function __construct(string $title, string $url, string $content, ?string $imageUrl = null, ?string $publishedAt = null)
    {

        $this->title = $title;
        $this->url = $url;
        $this->content = $content;
        $this->imageUrl = $imageUrl;
        $this->publishedAt = $publishedAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }


    public function getPublishedAt(): ?string
    {
        return $this->publishedAt;
    }

    public function getShortContent(): string
    {
        function trunc($phrase, $max_words)
        {
            $phrase_array = explode(' ', $phrase);
            if (count($phrase_array) > $max_words && $max_words > 0)
                $phrase = implode(' ', array_slice($phrase_array, 0, $max_words)) . '...';
            return $phrase;
        }

        return trunc($this->content, 10);
    }
}