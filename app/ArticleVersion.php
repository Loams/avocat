<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleVersion extends Model
{
	protected $fillable = ['id_version', 'origine', 'etat'];
	protected $dates = ['debut', 'fin'];
	protected $table = 'article_version';
	public $timestamps = false;
    public function article()
	{
		return $this->belongsTo('App\Article', 'article_id');
	}

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
