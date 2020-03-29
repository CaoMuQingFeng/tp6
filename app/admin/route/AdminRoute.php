<?php 

use think\facade\Route;

Route::rule('adminindex','AdminView/indexView','GET');
Route::rule('admin','AdminView/adminLogin','GET');

 ?>