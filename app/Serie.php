<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = ['nome'];
    protected $perPage = 10;
    protected $appends = ['links'];

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    // Mutator
    public function setNomeAttribute($nome)
    {
        $this->attributes['nome'] = ucfirst($nome);
    }

    public function getLinksAttribute() : array
    {
        return [
            'self' => "/api/series/{$this->id}",
            'episodios' => "/api/series/{$this->id}/episodios"
        ];
    }
}
