<?php

namespace App\Http\Controllers;
use App\Utilities\SpreadSheetManagemnt;
use Google_Service_Sheets_ValueRange;

class GsheetsController extends Controller
{
    public function __construct() {
        echo('Gsheets Controller works');
    }

    public function GsuitTest(){
        $sheets = new SpreadSheetManagemnt();
        $sheets->showDatas('testSheet');
    }
}
