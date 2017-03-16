<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class ArticleMeta
 * @package App
 */
class ArticleMeta extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = ['meta_id', 'joid', 'url', 'origine', 'nature', 'type'];
	/**
	 * @var array
	 */
	protected $dates = ['debut', 'fin'];
	/**
	 * @var string
	 */
	protected $dateFormat = 'Y.m.d';
	/**
	 * @var string
	 */
	protected $table = 'article_meta';
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
		$this->meta_id = $datas['id'];
		$this->joid = $datas['joid'];
		$this->url = $datas['url'];
		$this->origine = $datas['origne'];
		$this->nature = $datas['nature'];
		if(is_array($datas['type']))
			$datas['type'] = '';
		$this->type = $datas['type'];
		$this->debut = $datas['debut'];
		$this->fin = $datas['fin'];
		$this->save();
		return $this->id;
	}
}
