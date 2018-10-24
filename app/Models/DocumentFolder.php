<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class DocumentFolder extends Model{


	use Sortable;

    protected $table = 'rec_document_folders';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['folder_code', 'description'];

	public $timestamps = false;




    protected $attributes = [
        
        'slug' => '',
        'folder_code' => '',
        'description' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',


    ];



    
}
