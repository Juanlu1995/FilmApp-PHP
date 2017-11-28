<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Film extends Model {
    protected $table = 'films';
    protected $fillable = ['name','date','cover','category','rating'];
}