<?PHP
namespace SMBase;

class Smve extends \SMLib\SMForm
{
    public function redirect($url="",$array=array())
    {
        $STR=\Smce::app()->baseUrl."/".$url;
      if (isset($array["id"])) {
        $STR.="/".$array["id"];
        unset($array["id"]);
      }
      foreach($array as $key=>$value)
        $STR.="?".$key."=".$value;

        header('Location: '.$STR);
    }

}
