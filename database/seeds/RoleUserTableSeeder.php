<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\User;

class RoleUserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $admin = User::find(1);
    $admin->attachRole(1);


    $yardelysg = User::find(2);
    $yardelysg->attachRole(2);


    $eddys = User::find(3);
    $eddys->attachRole(3);

    $esgleel = User::find(4);
    $esgleel->attachRole(3);


    $nathalyj = User::find(5);
    $nathalyj->attachRole(3);
  }
}
