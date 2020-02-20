<?php

namespace App\Helpers;

class Utility 
{
    public static function redir($url)
    { 
        header('location: ' . URL_ROOT  . $url);
        exit();
    }
    
    public static function generateConfCode():string 
    {
        $code =  str_shuffle(substr(time(), 0, 10));
        return   str_shuffle(substr($code, 0, 4)) . str_shuffle(substr($code, 6, 10));
    }

    public static function generateAlphaNumStrings(string $limit):string
    {
        $alphabets = 'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghjklmnopqrstuvwxyz';
        $numbers = '0123456789';
        return substr(str_shuffle($alphabets.$numbers), 0, $limit);
    }
 
 
    public static function generateImage($width, $height)
    {
        
        $dir = sys_get_temp_dir();  
         
        if (!is_dir($dir) || !is_writable($dir)) {
            throw new \InvalidArgumentException(sprintf('Cannot write to directory "%s"', $dir));
        } 

        $name = md5(uniqid(empty($_SERVER['SERVER_ADDR']) ? '' : $_SERVER['SERVER_ADDR'], true));
        $filename = $name .'.jpg';
        $filepath = $dir . DIRECTORY_SEPARATOR . $filename; 

        $id = rand(1,99);
        $url = 'https://picsum.photos/id/'.$id.'/'.$width.'/'.$height;
                 
        if (function_exists('curl_exec')) {
            $fp = fopen($filepath, 'w');
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_FILE, $fp);   
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION , true);
            $success = curl_exec($ch) && curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200; 
           
            fclose($fp);
            curl_close($ch);

            if (!$success) { 
                unlink($filepath);
                return false;
            } 
        } 
        elseif (ini_get('allow_url_fopen')) { 
            // use remote fopen() via copy()
            $success = copy($url, $filepath);
        } 
        else {
            return new \RuntimeException('The image formatter downloads an image from a remote HTTP server. Therefore, it requires that PHP can request remote hosts, either via cURL or fopen()');
        }

        return $filepath;
    }

    public static function processFileUpload($input_name, $fileHandle, $access_id)
    {
        // Move to store uploaded file  
        $new_file_name = null;

        $passport_folders = ['passport', 'nok_passport', 'g1_passport', 'g2_passport'];
        
        if ($fileHandle->file($input_name) !== null && $fileHandle->file($input_name)->isValid()) { 
            $extension = strtolower($fileHandle->file($input_name)->extension());
            $new_file_name =  md5($access_id) . '_' . $input_name . '.' . $extension;
            
            if (in_array($input_name, $passport_folders)) $dir = 'passports';
            else if ($input_name === 'signature') $dir = 'signatures';
            else $dir = 'certificates';

            $fileHandle->$input_name->storeAs('uploads/images/'.$dir, $new_file_name, 's3');
        }
        return $new_file_name;
    }
 
}