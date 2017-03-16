<?php

use Sleimanx2\Plastic\Map\Blueprint;
use Sleimanx2\Plastic\Mappings\Mapping;

class AppArticle extends Mapping
{
    /**
     * Full name of the model that should be mapped
     *
     * @var string
     */
    protected $model = App\Article::class;

    /**
     * Run the mapping.
     *
     * @return void
     */
    public function map()
    {
        Map::create($this->getModelType(),function(Blueprint $map){
			$map->long ('id');
			$map->string ('titre');
			$map->string ('joid');
			$map->string ('description');
			$map->string ('nature');
			$map->string ('type');
			$map->date ('publication')->format ('dd-MM-yyyy');
			$map->date ('signature')->format ('dd-MM-yyyy');
        },$this->getModelIndex());
    }
}
