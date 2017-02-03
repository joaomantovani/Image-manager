<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Project;
use App\Models\Photo;
use Log;
use File;

class UploadController extends Controller
{
	/**
	 * [images description]
	 * @return [type] [description]
	 */
    public function save(Request $request) 
    {
	    //Pega o ID do projeto pela URL
	    $project_id = explode('/', $request->path())[3];

	    //Pega o projeto que vai ser salvo as fotos
	    $project = Project::find($project_id);

	    //path que ficará a imagem (sem nome)
	    $path = base_path() . '/public/images/project/';

	    //path completo que ficará a imagem (com nome)
	    $relative_path = 'images/project/' . $project->slug . '/';

	    //gera um nome aleatorio com a extensão da imagem
	    $file_name = str_random(20) . '.' . $request->file('qqfile')->getClientOriginalExtension();

    	//Faz o upload da imagem no path
    	$request->file('qqfile')->move(
	       $relative_path, $file_name
	    );

	    //Salva a foto no projeto
	    $photo = $project->photos()->create([
	        'name' => $request->qqfilename,
	        'path' => $relative_path . $file_name,
	        'uuid' => $request->qquuid,
	        'totalfilesize' => $request->qqtotalfilesize,
	    ]);

	    //Retorna mensagem de sucesso para o fineuploader
    	return response()->json(['success' => true]);
    }

    /**
     * [delete description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function delete(Request $request) 
    {
    	//Pega o QQUUID da photo pela URL
    	$qquuid = explode('/', $request->path())[4];

    	//Pega a foto pelo QQUUID
    	$photo = Photo::where('uuid', $qquuid)->first();

    	//Deleta a foto do diretorio
    	File::delete($photo->path);

    	//Deleta a foto do banco de dados
    	$photo->delete();

    	//Retorna mensagem de sucesso para o fineuploader
    	return response()->json(['success' => true]);	
    }

    /**
     * [recover description]
     * 
     * @return [type] [description]
     */
    public function recover($project_id) 
    {
    	//Pega o projeto que contém as fotos
    	$project = Project::find($project_id);

    	$arr = []; 
    	foreach ($project->photos as $key => $photo) {
    		$arr[] = [
    			"name" => $photo->name,
    			"uuid" => $photo->uuid,
    			"size" => $photo->totalfilesize,
    			"id" => $photo->id,
    			"thumbnailUrl" => asset($photo->path),
    		];
    	}

    	//Retorna mensagem de sucesso para o fineuploader
    	return response()->json($arr);


    	// return response()->json([[
    	//     "name" => $project->photos->first()->name,
    	//     "uuid" => $project->photos->first()->uuid,
    	//     "size" => "595284",
    	//     "id" => "208",
    	//     "thumbnailUrl" => asset('images/project/OHH_GEEZ/Gqx5XZ5bONdnVykcSEFr.jpg'),
    	// ]]);
    }

}

