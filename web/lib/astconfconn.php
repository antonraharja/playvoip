<?php
//return message valiable
function conf_add_record ($file_name, $id, $username, $secret, $callerid, $host, $type, $context, $dtmfmode, $nat, $canreinvite) 
{
  $fn = fopen($file_name, "a+");
  $content = ";BEGIN $id\n[$id]\ntype=$type\nusername=$username\nsecret=$secret\nhost=$host\ncallerid=$callerid <$id>\ncontext=$context\ndtmfmode=$dtmfmode\nmailbox=$id\nnat=$nat\ncanreinvite=$canreinvite\n;END $id\n\n";

  $ok = false;
  
  $string = "";
  while (!feof($fn)){
    $string .= fgetss($fn, 255);
    }

  if(!ereg("BEGIN $id", $string))
  {
    fputs($fn, $content);
    fclose($fn);
    $ok = true;
  }

  return $ok;
}

function conf_add_voicemail ($file_name, $id, $realname, $email)
{
  $fn = fopen($file_name, "a+");
  $content = ";BEGIN $id\n$id => $id,$realname,$email\n;END $id\n\n";

  $ok = false;
  
  $string = "";
  while (!feof($fn)){
    $string .= fgetss($fn, 255);
    }

  if(!ereg("BEGIN $id", $string))
  {
    fputs($fn, $content);
    fclose($fn);
    $ok = true;
  }

  return $ok;
}
		       
//return array result
function conf_get_record($file_name, $id)
{
  $arr_file = file($file_name);
  $cnt = 0;
  $read_start = "";
  $read_end = "";
  foreach($arr_file as $file_content)
  {
    
    if ($file_content==";BEGIN $id\n"){ $read_start = $cnt;}
    if ($file_content==";END $id\n") { $read_end = $cnt; }
    $cnt++;
  }
  
  if ($read_start=="" AND $read_end=="")
  {
    $result = array();
  }
  else
  {
    for($i=$read_start; $i<=$read_end; $i++)
    {
      $result[] = $arr_file[$i];
    }
  }
  return $result;
}

//return message valiable
function conf_del_record($file_name, $id)
{
  $arr_file = file($file_name);
  $cnt = 0;
  $read_start = "";
  $read_end = "";

  $ok = false;

  foreach($arr_file as $file_content)
  {
    if ($file_content==";BEGIN $id\n"){ $read_start = $cnt;}
    if ($file_content==";END $id\n") { $read_end = $cnt; }
    $cnt++;
  }
  
  if (!($read_start=="" AND $read_end==""))
  {
    if (count($arr_file)==13)
    {
      $fn = fopen($file_name, "w+");
      fputs($fn, "");  
      fclose($fn);
    }
    else 
    {
      //if first row
      if ($read_start==0)
      {
        $fn = fopen($file_name, "w+");
        $string = "";
        for ($i=13; $i<count($arr_file); $i++)
        {
           $string .= $arr_file[$i];
        }
        fputs($fn, $string);
        fclose($fn);
      }
      //if last row
      elseif (count($arr_file)==($read_end+2))
      {
        $fn = fopen($file_name, "w+");
        $string = "";
        for ($i=0; $i<=($read_start-2); $i++)
        {
           $string .= $arr_file[$i];
        }
        $string .= "\n";
        
        fputs($fn, $string);
        fclose($fn);
      }
      // if middle row
      else
      {
        $fn = fopen($file_name, "w+");
        $string = "";
        for ($i=0; $i<=($read_start-2); $i++)
        {
          $string .= $arr_file[$i];
        }
        
        $string .= "\n";
        
        for ($i=($read_end+2); $i<count($arr_file); $i++)
        {
          $string .= $arr_file[$i];
        }
        
        fputs($fn, $string);
        fclose($fn);
      }
    }
    $ok = true;
  }
  return $ok;
}

//return message valiable
function conf_update_record($file_name, $id, $username, $secret, $callerid, $host, $type, $context, $dtmfmode, $nat, $canreinvite)
{
  $arr_file = file($file_name);
  $cnt = 0;
  $read_start = "";
  $read_end = "";

  $ok = false;
  
  foreach($arr_file as $file_content)
  {
    if ($file_content==";BEGIN $id\n"){ $read_start = $cnt;}
    if ($file_content==";END $id\n") { $read_end = $cnt; }
    $cnt++;
  }
  
  if (!($read_start=="" AND $read_end==""))
  {
    if (count($arr_file)==13)
    {
      $fn = fopen($file_name, "w+");
      fputs($fn, "");  
      fclose($fn);
    }
    else 
    {
      for($i=$read_start; $i<=$read_end; $i++)
      {
        $content_current[] = $arr_file[$i];
      }
      
      //if first row
      if ($read_start==0)
      {
        $fn = fopen($file_name, "w+");
        $string = "";
        for ($i=13; $i<count($arr_file); $i++)
        {
           $string .= $arr_file[$i];
        }
        fputs($fn, $string);
        fclose($fn);
      }
      //if last row
      elseif (count($arr_file)==($read_end+2))
      {
        $fn = fopen($file_name, "w+");
        $string = "";
        for ($i=0; $i<=($read_start-2); $i++)
        {
           $string .= $arr_file[$i];
        }
        $string .= "\n";
        
        fputs($fn, $string);
        fclose($fn);
      }
      // if middle row
      else
      {
        $fn = fopen($file_name, "w+");
        $string = "";
        for ($i=0; $i<=($read_start-2); $i++)
        {
          $string .= $arr_file[$i];
        }
        
        $string .= "\n";
        
        for ($i=($read_end+2); $i<count($arr_file); $i++)
        {
          $string .= $arr_file[$i];
        }
        
        fputs($fn, $string);
        fclose($fn);
      }
      
    }
    
    //set update 
    $fn = fopen($file_name, "a+");
    
    $string_update = ";BEGIN $id\n[$id]\ntype=$type\nusername=$username\nsecret=$secret\nhost=$host\ncallerid=$callerid <$id>\ncontext=$context\ndtmfmode=$dtmfmode\n";
    $string_update .= "mailbox=$id\nnat=$nat\ncanreinvite=$canreinvite\n;END $id\n\n";
    
    fputs($fn, $string_update);
    fclose($fn);
    
    $ok = true;
  }
  return $ok;
}
?>