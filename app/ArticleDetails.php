<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticleDetails
 * @package App
 */
class ArticleDetails extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = ['ministere', 'nature', 'titre', 'contenu'];
	/**
	 * @var array
	 */
	protected $dates = ['publication', 'signature'];
	/**
	 * @var string
	 */
	protected $dateFormat = 'Y.m.d';
	/**
	 * @var string
	 */
	protected $table = 'article_details';
	/**
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function article()
	{
		return $this->belongsTo('App\Article');
	}

	/**
	 * @param $datas
	 *
	 * @return mixed
	 */
	public function store($datas)
	{
		$this->ministere = $datas['ministere'];
		$this->nature = $datas['nature'];
		$this->publication = $datas['publication'];
		$this->signature = $datas['signature'];
		$this->titre = $datas['titre'];
		$this->contenu = $datas['contenu'];
		$this->save();
		return $this->id;
	}
}
