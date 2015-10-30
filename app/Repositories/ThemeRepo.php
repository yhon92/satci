<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Theme;

class ThemeRepo extends BaseRepo
{

  public function getModel()
  {
    return new Theme;
  }

  public function getListThemes()
  {
    return Theme::get();
      // orderby('first_name', 'ASC')
      // ->paginate();
  }

  public function newTheme()
  {
    $theme = new Theme();
  }

  static public function get($id)
  {
    return Theme::find($id);
  }

}