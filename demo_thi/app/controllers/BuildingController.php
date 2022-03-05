<?php
namespace App\Controllers;
use App\Models\Building;
use App\Models\Room;
class BuildingController{
    
    public function index(){

        $model = Building::all();
        return view('building.index', ['model' => $model]);

    }

    public function addNew(){

        return view('building.add-form');

    }

    public function saveAdd(){

        $file = $_FILES['image']['tmp_name'];
        $path = './public/images/' . $_FILES['image']['name'];
        move_uploaded_file($file, $path);


        Building::create([ 'image' => $_FILES['image']['name'], 'name' => $_POST['name'], 'address' => $_POST['address']]);
        header('location: ' . BASE_URL . 'buildings');
    }

    public function updateForm($id){

        $model = Building::find($id);
        return view('building.update-form', ['model' => $model]);

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
        

        $model = Building::find($id);

        $model->fill([ 'image' => $logo, 'name' => $_POST['name'], 'address' => $_POST['address']]);

        $model->save();
        header('location: ' . BASE_URL . 'buildings');

    }

    public function xoa($id){
        $buildingOfRoom = Room::where('school_id', '$id');
        foreach ($buildingOfRoom as $key => $value) {
            Room::destroy($value->id);
        }
        Building::destroy($id);
        header('location: ' . BASE_URL . 'buildings');
    }
    
}
