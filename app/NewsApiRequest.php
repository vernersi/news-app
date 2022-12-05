<?php

namespace App;

use App\Models\ArticlesCollection;
use jcobhams\NewsApi\NewsApi;
use App\Models\Article;


class NewsApiRequest
{

    private ?string $q=null;
    private ?string $category=null;
    private ?string $country=null;
    private ArticlesCollection $articles;

    public function getApiResponse():void
    {
        $apiToken = $_ENV['apiToken'];
        $newsApi = new NewsApi($apiToken);
        $this->articles= new ArticlesCollection();

        if (!is_null($this->q)) {
            $articlesApiResponse = $newsApi->getEverything($this->q);
            foreach ($articlesApiResponse->articles as $article) {
                $this->articles->addArticleToCollection(new Article(
                    $article->title,
                    $article->url,
                    $article->description,
                    $article->urlToImage,
                    $article->publishedAt
                ));
            }
        }
        if (!is_null($this->category)) {
            $articlesApiResponse = $newsApi->getEverything($category=$this->category);
            //var_dump($articlesApiResponse);
            foreach ($articlesApiResponse->articles as $article) {
                $this->articles->addArticleToCollection(new Article(
                    $article->title,
                    $article->url,
                    $article->description,
                    $article->urlToImage,
                    $article->publishedAt
                ));
            } //var_dump($this->articles);

            if (!is_null($this->country)) {
                $articlesApiResponse = $newsApi->getEverything($this->country);
                foreach ($articlesApiResponse->articles as $article) {
                    $this->articles->addArticleToCollection(new Article(
                        $article->title,
                        $article->url,
                        $article->description,
                        $article->urlToImage,
                        $article->publishedAt
                    ));
                }
            }
        }
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function setQ(string $q): void
    {
        $this->q = $q;
    }

    public function getArticles():ArticlesCollection{
        //var_dump($this->articles);
        return $this->articles;
    }
}

//SECTIONS -> "business" "entertainment" "general" "health" "science" "sports" "technology"

