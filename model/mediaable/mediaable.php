<?php

class mediaable
{
    public function uploadMedia($file, $fileModelId, $fileModelName)
    {
        try {
            $fileMain = $file;
            $file_name = $fileMain['name'];
            $file_size = $fileMain['size'];
            $file_tmp = $fileMain['tmp_name'];
            $file_type = $fileMain['type'];
            $year = date("Y");
            $month = date("M");
            $day = date("d");
            $timestamp = date('U');
            $current_dir = '../../uploads/';
            $current_dir = $this->check_dir($current_dir, 'Visa_field');
            $current_dir = $this->check_dir($current_dir, $year);
            $current_dir = $this->check_dir($current_dir, $month);
            $current_dir = $this->check_dir($current_dir, $day);
            $current_dir = $this->check_dir($current_dir, $timestamp);
            $file_name2 = str_replace(' ', '_', basename($file_name));
            $fileMainName = $current_dir . $file_name2;
            if (move_uploaded_file($file_tmp, $fileMainName)) {
                $urlFilter = $this->makeUrl($fileMainName);
                $query = mysqlQuery("INSERT INTO `mediaables`(`id`, `filename`, `extension`, `size`, `url`, `model_id`, `model_name`, `created_at`) VALUES (NULL,'$file_name','$file_type','$file_size','$urlFilter','$fileModelId','$fileModelName',CURRENT_TIMESTAMP)");
                return $urlFilter;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function uploadMediaMultiple($file, $fileModelId, $fileModelName)
    {
        try {
            $fileMain = $file;
            $num_files = count($fileMain['name']);
            for ($i = 0; $i < $num_files; $i++) {
                $file_name = $fileMain['name'][$i];
                $file_size = $fileMain['size'][$i];
                $file_tmp = $fileMain['tmp_name'][$i];
                $file_type = $fileMain['type'][$i];
                if(empty($file_name))
                {
                    continue;
                }
                $year = date("Y");
                $month = date("M");
                $day = date("d");
                $timestamp = date('U');
                $current_dir = '../../uploads/';
                $current_dir = $this->check_dir($current_dir, $fileModelName);
                $current_dir = $this->check_dir($current_dir, $year);
                $current_dir = $this->check_dir($current_dir, $month);
                $current_dir = $this->check_dir($current_dir, $day);
                $current_dir = $this->check_dir($current_dir, $timestamp);
                $file_name2 = str_replace(' ', '_', basename($file_name));
                $fileMainName = $current_dir . $file_name2;
                if (move_uploaded_file($file_tmp, $fileMainName)) {
                    $urlFilter = $this->makeUrl($fileMainName);
                    $query = mysqlQuery("INSERT INTO `mediaables`(`id`, `filename`, `extension`, `size`, `url`, `model_id`, `model_name`, `created_at`) VALUES (NULL,'$file_name','$file_type','$file_size','$urlFilter','$fileModelId','$fileModelName',CURRENT_TIMESTAMP)");
                    // return $urlFilter;
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function check_dir($current_dir, $type)
    {

        if (!is_dir($current_dir . "/" . $type)) {

            mkdir($current_dir . "/" . $type);
        }

        $current_dir = $current_dir . "/" . $type . "/";

        return $current_dir;
    }
    public function fileSizeCheck($file, $size)
    {
        $file_size = $file['size'];
        if ($file_size > $size) {
            throw new Exception("Maximum Size Extends");
        }
        return true;
    }
    public function makeUrl($urlPass)
    {
        $url = $urlPass;
        $pos = strstr($url, 'uploads');
        if ($pos != false) {
            $newUrl1 = preg_replace('/(\/+)/', '/', $urlPass);
            $newUrl = str_replace('../', '', $newUrl1);
        } else {
            $newUrl =  $urlPass;
        }
        return $newUrl;
    }
}
