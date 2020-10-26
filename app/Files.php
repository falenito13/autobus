<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed route_id
 * @property mixed file_path
 * @property mixed file_url
 * @property mixed route_name
 * @property mixed file_name
 * @property mixed mime_type
 * @property mixed thumbs
 * @property mixed type
 */
class Files extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'files';

}
