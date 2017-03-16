<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sleimanx2\Plastic\Searchable;

/**
 * Class Article
 * @package App
 */
class Article extends Model
{
	use Searchable;

	/**
	 * @var array
	 */
	protected $fillable = ['article_id','meta_id', 'details_id'];
	/**
	 * @var string
	 */
	protected $table = 'article';
	/**
	 * @var bool
	 */
	public $timestamps = false;


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function versions()
	{
		return $this->hasMany('App\ArticleVersion');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function meta()
	{
		return $this->hasOne('App\ArticleMeta', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function	details()
	{
		return $this->hasOne('App\ArticleDetails', 'id');
	}

	/**
	 * @param $this_id
	 *
	 * @return mixed
	 */
	public function checkArticleExiste($this_id)
	{

		return $this->where('id_article', '=', $this_id)->exists();
	}

	/**
	 * @param $data
	 * @param $id_meta
	 * @param $id_details
	 *
	 * @return mixed
	 */
	public function store($data, $id_meta, $id_details)
	{
		$this->id_article = $data;
		$this->meta_id = $id_meta;
		$this->details_id = $id_details;
		$this->save();
		return $this->id;
	}


	/**
	 * @return array
	 */
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

	/**
	 * @param $date
	 *
	 * @return mixed
	 */
	public function getElasticDate($date )
	{

		if ( isset( $date ) ) {

			return $date->format('Y-m-d');
		}
	}
}
