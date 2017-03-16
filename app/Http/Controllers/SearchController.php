<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function executeSearch(Request $request)
	{
		$articles = Article::search()->querystring('*' . $request->search_query . '*' , ['fields' => ['titre^4' ,
			'description',
			'ministere',
			'joid',
			'nature',
			'joid',
			'type',
			'publication^3',
			'signature^6'
		]])->size(15)->get()->hits();

		return response()->json(['articles' => $articles]);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function search()
	{
		return view('search');
	}
}
