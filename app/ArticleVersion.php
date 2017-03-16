<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticleVersion
 * @package App
 */
class ArticleVersion extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = ['id_version', 'origine', 'etat'];
	/**
	 * @var array
	 */
	protected $dates = ['debut', 'fin'];
	/**
	 * @var string
	 */
	protected $table = 'article_version';
	/**
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function article()
	{
		return $this->belongsTo('App\Article', 'article_id');
	}

	/**
	 * @param $datas
	 * @param $id_article
	 */
	public function store($datas, $id_article)
	{
		$this->id_version = $datas['id'];
		$this->origine = $datas['origine'];
		$this->article_id = $id_article;
		$this->etat = $datas['etat'];
		$this->debut = $datas['debut'];
		$this->fin = $datas['fin'];
		$this->save();
	}
}
