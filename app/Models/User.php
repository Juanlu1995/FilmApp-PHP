<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User de la tabla user de la base de datos
 * @package App\Models
 */
class User extends Model{

protected $table = "user";
protected $fillable = ['name','password','email'];

}