<?php
namespace App\Controllers;
use App\Models\Room;
use App\Models\Building;
class RoomController{
    public function index(){
        $model = Room::all();
        return view('room.index', ['model' => $model]);

    }

    public function addNew(){
        $building = Building::all();


        return view('room.add-form',['building' => $building]);

    }

    public function saveAdd(){

        $file = $_FILES['image']['tmp_name'];
        $path = './public/images/' . $_FILES['image']['name'];
        move_uploaded_file($file, $path);


        Room::create([ 'image' => $_FILES['image']['name'], 'room_number' => $_POST['room_number'], 'building_id' => $_POST['building_id'], 'floor' => $_POST['floor'], 'status' => $_POST['status']]);
        header('location: ' . BASE_URL . 'rooms');
    }

    public function updateForm($id){
        $building = Building::all();

        $model = Room::find($id);
        return view('room.update-form', ['model' => $model, 'building'=>$building]);

    }

    public function saveUpdate($id){

        if($_FILES['image']['name']){


            $file = $_FILES['image']['tmp_name'];
            $path = './public/images/' . $_FILES['image']['name'];
            move_uploaded_file($file, $path);

            $logo = $_FILES['image']['name'];
        }else{

            $logo = $_POST['logo_db'];

        }
        

        $model = Room::find($id);

        $model->fill([ 'image' => $logo, 'room_number' => $_POST['room_number'], 'building_id' => $_POST['building_id'], 'floor' => $_POST['floor'], 'status' => $_POST['status']]);

        $model->save();
        header('location: ' . BASE_URL . 'rooms');

    }

    public function xoa($id){    
        Room::destroy($id);
        header('location: ' . BASE_URL . 'rooms');
    }
}

?>