<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Building extends Model{
    protected $table = 'buildings';

    protected $fillable = ['name', 'image', 'address'];

    public function rooms(){
        return $this->hasMany(Laptop::class, 'building_id');
    }
}
?>