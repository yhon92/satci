<?php 
namespace SATCI\Repositories;

use SATCI\Entities\AssignComment;

class AssignCommentRepo extends BaseRepo
{

  public function getModel()
  {
    return new AssignComment;
  }

  public static function create($data)
  {
    return AssignComment::create($data);
  }

  public static function get($id)
  {
    return AssignComment::find($id);
  }

  public static function getListAssignCommentes()
  {
    return AssignComment::get();
  }

}