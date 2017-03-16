<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sleimanx2\Plastic\Searchable;

class Article extends Model
{
	use Searchable;

	protected $fillable = ['article_id','meta_id', 'details_id'];
	protected $table = 'article';
	public $timestamps = false;



	public function versions()
	{
		return $this->hasMany('App\ArticleVersion');
	}

	public function meta()
	{
		return $this->hasOne('App\ArticleMeta', 'id');
	}

	public function	details()
	{
		return $this->hasOne('App\ArticleDetails', 'id');
	}

	public function checkArticleExiste($this_id)
	{

		return $this->where('id_article', '=', $this_id)->exists();
	}

	public function store($data, $id_meta, $id_details)
	{
		$this->id_article = $data;
		$this->meta_id = $id_meta;
		$this->details_id = $id_details;
		$this->save();
		return $this->id;
	}


	public function buildDocument ()
	{
		$data = [
			'id'               	=> $this->id ,
			'titre'             => $this->details->titre ,
			'joid'				=> $this->meta->joid,
			'description'      	=> $this->details->description ,
			'nature'    		=> $this->details->nature ,
			'type'  			=> $this->meta->type ,
			'publication'      	=> $this->getElasticDate($this->details->publication) ,
			'signature'      	=> $this->getElasticDate($this->details->signature) ,
		];
		return $data;
	}

	public function getElasticDate( $date )
	{

		if ( isset( $date ) ) {

			return $date->format('Y-m-d');
		}
	}
}
