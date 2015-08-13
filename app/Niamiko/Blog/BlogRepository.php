<?php 

class BlogRepository{

    public static function saveAvatar($avatar){

        $dir = '/images/blog' . date('/Y/m/d/');

        do {
            $filename = str_random(30) . '.jpg';
        } 
        while (File::exists(public_path() . $dir . $filename));

        $avatar->move(public_path() . $dir, $filename);
        
        return $dir . $filename;
    }
    
}