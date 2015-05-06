<?php

namespace App\Repositories;

use App\Article;

class ArticleRepository
{

	public function latest10()
	{
		return Article::query()->orderBy('id', 'desc')->limit(10)->get();
	}
}