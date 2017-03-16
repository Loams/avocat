<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleDetails extends Model
{
    protected $fillable = ['ministere', 'nature', 'titre', 'contenu'];
    protected $dates = ['publication', 'signature'];
	protected $dateFormat = 'Y.m.d';
	protected $table = 'article_details';
	public $timestamps = false;

	public function article()
	{
		return $this->belongsTo('App\Article');
	}

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
