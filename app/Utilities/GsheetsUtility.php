<?php
namespace App\Utilities;
    use Log;
    use Config;
    use Google_Service_Sheets_ValueRange;

    class SpreadSheetManagemnt{
    private $CLIENT;
    private $SERVICE;
    private $SPREAD_SHEET;
    private $SPREAD_SHEET_ID;
  /**
   * Returns an authorized API client.
   * @return Google_Client the authorized client object
   */
    public function __construct() {

    $this->CLIENT = new \Google_Client();
    $this->CLIENT->setApplicationName("Google Sheets Basecamp API Integration");
    $this->CLIENT->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
    $this->CLIENT->setAccessType('offline');
    $this->CLIENT->setAuthConfig(storage_path('GSuite/credentials.json'));

    $this->SPREAD_SHEET_ID = '1zQsjSh_8bR7plR2dSC0CGNm66uUX56rlS03faF8B8k8';

    $this->SERVICE = new \Google_Service_Sheets($this->CLIENT);
    $this->SPREAD_SHEET =  $this->SERVICE->spreadsheets->get($this->SPREAD_SHEET_ID);
  }

    public function GsuitTest() {
        $this->showDatas('testSheet');
    }

  /**
   * Function to show sheet datas
   * @param string sheet name
   * @return boolean
   */
  public function showDatas($sheetName)
  {
      try{
        // column ranges in spreadsheet
        $range = "'".$sheetName."'!A2:F3";
        $values = [
            ['This', 'is', 'a', 'new', 'row', 'test']
           ];
           $body = new Google_Service_Sheets_ValueRange([
               'values' => $values
           ]);
           $params = [
               'valueInputOption' => 'RAW'
           ];
           $insert = [
               'insertDataOption' => 'INSERT_ROWS'
           ];
        $rows = $this->SERVICE->spreadsheets_values->append(
            $this->SPREAD_SHEET_ID, $range, $body, $params, $insert
        );
        dd($rows);

      }catch( \Throwable $e){
          echo('erros');
          //Log::error($e);
      }
  }
}
