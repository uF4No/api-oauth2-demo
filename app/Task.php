<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'description', 'completed',
  ];

  //relationship with User model
  public function user(){
    return $this->belongsTo('App\User');
  }

  public function scopeCompleted($query){
    return $query->where('completed', true);
  }

  public function scopePending($query){
    return $query->where('completed', false);
  }
}
