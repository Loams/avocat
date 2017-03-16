<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleDetails;
use App\ArticleMeta;
use App\ArticleVersion;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function testJson()
	{
		$datas = file_get_contents(resource_path('assets\json\data.json'));
		$datas = json_decode($datas, true);
		//
		dd($datas['LEGIARTI000006365882']);
	}

	public function index()
	{
		//get all article
		$articles = Article::with('meta', 'details', 'versions')->orderBy('id', 'desc')->paginate(15);
		//return
		return view('article.index', compact('articles'));
	}

	public function show($id)
	{
		$article = Article::findOrFail($id);
		return view('article.show', compact('article'));
	}

	public function store()
	{
		return view('article.store');
	}


	public function importArticle(Article $articles)
	{

		ini_set('max_execution_time', 180);
		$datas = file_get_contents(resource_path('assets\json\data.json'));
		$datas = json_decode($datas, true);

		//save data in database

		foreach($datas as $data => $value)
		{
			//check si deja dans la base
			if(!$articles->checkArticleExiste($data))
			{
				//si pas dans la base insérer
				$id_meta = $this->saveMeta($value['meta'], new ArticleMeta());
				$id_details = $this->saveDetails($value['details'], new ArticleDetails());
				$id_article = $this->saveArticle($data, $id_meta, $id_details, new Article());

				//insertion des versions
				foreach($value['versions'] as $versions)
				{
					$this->saveVersion($versions, $id_article, new ArticleVersion());
				}
			}
		}
		return view('article.index')->with('success', 'importation de la base ok');
	}

	private function saveDetails($datas, ArticleDetails $articleDetails)
	{
		return $articleDetails->store($datas);
	}

	private function saveMeta($datas, ArticleMeta $articleMeta)
	{
		return $articleMeta->store($datas);
	}

	private function saveVersion($datas,$id_article, ArticleVersion $articleVersion)
	{
		$articleVersion->store($datas, $id_article);
	}

	private function saveArticle($data, $id_meta, $id_details, Article $article)
	{
		return $article->store($data, $id_meta, $id_details);

	}
}
