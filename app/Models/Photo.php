<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Photo extends Model
{
    use CrudTrait;

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    //protected $table = 'photos';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'path', 'project_id', 'uuid', 'qqfilename', 'totalfilesize', 'mimeType', 'size'];
    // protected $hidden = [];
    // protected $dates = [];
    // 
    protected $casts = [
        'photo' => 'array'
    ];

    /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	/**
     * Get the post project that owns the photo
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Project');
    }

    /*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

    /*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

    /*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Faz o upload das fotos
	 *  
	 * @param [type] $value [description]
	 */
	public function setPhotosAttribute($value)
    {
        $attribute_name = "photo";
        $disk = "public";
        $destination_path = "folder_1/subfolder_1";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
