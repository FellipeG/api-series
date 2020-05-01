<?php


namespace App\Http\Controllers;

use App\Episodio;

class EpisodiosController extends BaseController
{
    public function __construct()
    {
        parent::__construct(Episodio::class);
    }

    public function seriesEps(int $serieId)
    {
        return Episodio::where('serie_id', $serieId)->paginate();
    }
}
