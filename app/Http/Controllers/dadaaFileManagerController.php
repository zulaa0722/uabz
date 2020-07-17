<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Folder;
use Carbon\Carbon;
use File;
use Response;

class dadaaFileManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dadaaFileManagerShow($type){
        return view('dadaa_file_manager.browse_folder', compact("type"));
    }

    public function createFolder(Request $req){
        try {
            if($req->pid == "dadaa123"){
                $path = storage_path().'/app/public/dadaa/' . $req->fn;
            }
            else{
                $path = storage_path().'/app/' . $req->pid . '/' . $req->fn;
            }
            if(!file_exists($path)){
                File::makeDirectory($path, $mode=0777, true, true);
                $array = array(
                    'status' => 'success',
                    'msg' => 'Амжилттай хадгаллаа'
                );
            }else{
                // File::makeDirectory($path, $mode=0777, true, true);
                $array = array(
                    'status' => 'error',
                    'msg' => 'Энэ хавтас үүссэн байна'
                );
            }

            return json_encode($array);
        }catch (\Illuminate\Database\QueryException $ex){
            $array = array(
                'status' => 'error',
                'msg' => 'Сервер алдаа!!! Веб мастерт хандана уу!!!'
            );
            return json_encode($array);
        }
    }

    public function editFolder(Request $req){
        if($req->pid == "dadaa123"){
            $path = storage_path().'/app/public/dadaa/';
        }
        else{
            $path = storage_path() . '/app/' . $req->pid . '/';
        }
        // File::makeDirectory($path . $req->newFolder, $mode=0777, true, true);
        rename($path . $req->oldFolder, $path . $req->newFolder);
        $array = array(
            'status' => 'success',
            'msg' => 'Амжилттай заслаа!!!'
        );
        return json_encode($array);
    }

    public function deleteFolder(Request $req){
        File::deleteDirectory(storage_path().'/app/' . $req->fp);
        $array = array(
            'status' => 'success',
            'msg' => 'Амжилттай устгалаа!!!'
        );
        return json_encode($array);
    }

    public static function showFolders(){
        // return storage_path();
        // $path = storage_path().'/app/public/dadaa';
        // File::makeDirectory($path, $mode=0777, true, true);
        $directories = Storage::directories('public/dadaa');
        // unset($directories[0], $directories[1]);
        return $directories;
        // dd($directories);
    }

    public static function showFolders1($path){
        // return storage_path();
        // $path = storage_path().'/app/public/dadaa';
        // File::makeDirectory($path, $mode=0777, true, true);
        if($path == "dadaa123")
            $path1 = 'public/dadaa';
        else
            $path1 = $path;
        $directories = Storage::directories($path1);
        // unset($directories[0], $directories[1]);
        return $directories;
        // dd($directories);
    }

    public static function getFiles($path){
        if($path == "dadaa123")
            $path1 = 'public/dadaa';
        else
            $path1 = $path;
        $directories = Storage::files($path1);
        return $directories;

    }

    public function getLeftFolders(){
        return view('dadaa_file_manager.showLeftFolders');
    }

    public function getRightFolders(Request $req){
        $path = $req->pid;
        return view('dadaa_file_manager.showRightFolders', compact('path'));
    }

    public function resizeImagePost(Request $request)
    {
        $rules = array('image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048');
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return Response::json(array(
                'success' => 'bError',
                'errors' => "Зургын өргөтгөл эсвэл хэмжээ 2MB-аас ихэдсэн байна!!!"
            )); // 400 being the HTTP code for an invalid request.
        }

        $image = $request->file('image');
        $input['imagename'] = $image->getClientOriginalName().'.'.$image->extension();
        if($request->path == "dadaa123")
            $path1 = 'public/dadaa';
        else
            $path1 = $request->path;
        $destinationPath = storage_path().'/app/' . $path1;
        $image->move($destinationPath, $input['imagename']);

        $alert[] = array(
          'success'=>"success",
          'msg'=>"Амжилттай хадгаллаа!!!"
        );
        return Response::json($alert);
    }

    public function deleteFile(Request $req){
        try {
            $image_path = storage_path().'/app/' . $req->path;
            if(file_exists($image_path)) {
                File::delete($image_path);
                $array = array(
                    'status' => 'success',
                    'msg' => 'Амжилттай устгалаа!!!'
                );
                return json_encode($array);
            }
            else{
                $array = array(
                    'status' => 'error',
                    'msg' => 'Зураг олдсонгүй!!!'
                );
                return json_encode($array);
            }
        }catch (\Illuminate\Database\QueryException $ex){
            $array = array(
                'status' => 'error',
                'msg' => 'Сервер алдаа!!! Веб мастерт хандана уу!!!'
            );
            return json_encode($array);
        }
    }
}
