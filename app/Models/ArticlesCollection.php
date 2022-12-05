<?php

namespace App\Models;


class ArticlesCollection
{
    private array $articles = [];

    public function addArticleToCollection(Article $article): void
    {
        $this->articles[] = $article;
    }

    public function getArticles(): array
    {
        return $this->articles;
    }
}

