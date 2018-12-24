<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text;

class TextController extends Controller
{
    public $number=[];
    public $arrname=array();
    public $arr = array();
     public function getText() {
         $texts = Text::all();
         for($i=0;$i<count($texts);$i++) {
             echo ($text = $texts[$i]->text).'<br/>';
             $arr = explode(' ',$text);
         }
         for($i=0;$i<3;$i++) {
          $n = rand(0,count($arr));
          $arrname[$i] = $arr[$n];
          $arr[$n] = NULL;
          print_r($n." ");
          
         }
         print_r($arr);
         print_r($arrname);

         return view('index',compact('texts','arr'));
         
     }
}
