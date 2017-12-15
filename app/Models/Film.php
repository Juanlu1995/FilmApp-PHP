<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Film de la tabla films de la base de datos
 * @package App\Models
 */
class Film extends Model {
    protected $table = 'films';
    protected $fillable = ['name','date','cover','category','rating'];
}