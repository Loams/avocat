<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ArticleMeta extends Model
{
    protected $fillable = ['meta_id', 'joid', 'url', 'origine', 'nature', 'type'];
    protected $dates = ['debut', 'fin'];
    protected $dateFormat = 'Y.m.d';
	protected $table = 'article_meta';
	public $timestamps = false;

	public function article()
	{
		return $this->belongsTo('App\Article');
	}
	
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
