<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function executeSearch(Request $request)
	{
		$articles = Article::search()->querystring('*' . $request->search_query . '*' , ['fields' => ['titre^4' ,
			'description',
			'joid',
			'nature',
			'joid',
			'type',
			'publication^3',
			'signature^6'
		]])->size(15)->get()->hits();

		return response()->json(['articles' => $articles]);
	}

	public function search()
	{
		return view('search');
	}
}
