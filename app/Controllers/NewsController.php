<?php

namespace App\Controllers;

use App\NewsApiRequest;
use App\Template;


class NewsController
{

    public function index(): Template
    {
        $country = 'lv';
        $requestedArticles = new NewsApiRequest();
        $requestedArticles->setCategory($country);
        $requestedArticles->getApiResponse();
        $collection = $requestedArticles->getArticles();
        $response = $response = $collection->getArticles();
        return new Template('articles/article.twig', [
            'articles' => $response
        ]);
        //var_dump($response);
    }

    public function section(): Template
    {
        $section = $_GET['section'];
        $requestedArticles = new NewsApiRequest();
        $requestedArticles->setCategory($section);
        $requestedArticles->getApiResponse();
        $collection = $requestedArticles->getArticles();
        $response = $collection->getArticles();
        return new Template('articles/article.twig', [
            'articles' => $response
        ]);
    }

    public function search(): Template
    {
        $search = (string)$_GET['search'];
        //var_dump($search);
        $requestedArticles = new NewsApiRequest();
        $requestedArticles->setQ($search);
        $requestedArticles->getApiResponse();
        $collection = $requestedArticles->getArticles();
        $response = $collection->getArticles();
        return new Template('articles/article.twig', [
            'articles' => $response
        ]);
    }


}