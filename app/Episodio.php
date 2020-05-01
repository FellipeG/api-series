<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    protected $fillable = ['temporada', 'numero', 'serie_id', 'assistido'];
    protected $perPage = 10;
    protected $appends = ['links'];

    public function serie()
    {
        $this->belongsTo(Serie::class);
    }

    // Accessor
    public function getAssistidoAttribute($assistido) : bool
    {
        return $assistido;
    }

    public function getLinksAttribute($links) : array
    {
        return [
            'self' => "/api/episodios/{$this->id}",
            'serie' => "/api/serie/{$this->serie_id}"
        ];
    }
}
