<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleDetails;
use App\ArticleMeta;
use App\ArticleVersion;
use Illuminate\Http\Request;

/**
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{
	/**
	 *
	 */
	public function testJson()
	{
		$datas = file_get_contents(resource_path('assets\json\data.json'));
		$datas = json_decode($datas, true);
		//
		dd($datas['LEGIARTI000006365882']);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		//get all article
		$articles = Article::with('meta', 'details', 'versions')->orderBy('id', 'desc')->paginate(15);
		//return
		return view('article.index', compact('articles'));
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show($id)
	{
		$article = Article::findOrFail($id);
		return view('article.show', compact('article'));
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function store()
	{
		return view('article.store');
	}


	/**
	 * @param Article $articles
	 *
	 * @return $this
	 */
	public function importArticle(Article $articles)
	{

		ini_set('max_execution_time', 600);
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

		return redirect(route('article.index'))->with('success', 'importation de la base ok');
	}

	/**
	 * @param                $datas
	 * @param ArticleDetails $articleDetails
	 *
	 * @return mixed
	 */
	private function saveDetails($datas, ArticleDetails $articleDetails)
	{
		return $articleDetails->store($datas);
	}

	/**
	 * @param             $datas
	 * @param ArticleMeta $articleMeta
	 *
	 * @return mixed
	 */
	private function saveMeta($datas, ArticleMeta $articleMeta)
	{
		return $articleMeta->store($datas);
	}

	/**
	 * @param                $datas
	 * @param                $id_article
	 * @param ArticleVersion $articleVersion
	 */
	private function saveVersion($datas, $id_article, ArticleVersion $articleVersion)
	{
		$articleVersion->store($datas, $id_article);
	}

	/**
	 * @param         $data
	 * @param         $id_meta
	 * @param         $id_details
	 * @param Article $article
	 *
	 * @return mixed
	 */
	private function saveArticle($data, $id_meta, $id_details, Article $article)
	{
		return $article->store($data, $id_meta, $id_details);

	}
}
