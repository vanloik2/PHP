<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Room extends Model{
    protected $table = 'class_rooms';

    protected $fillable = ['room_number', 'building_id', 'floor', 'image', 'status'];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }
}
?>