<?php

class UserRepository{


   public static function saveSocialUser($email, $first_name, $last_name, $gender){
        
        // создаём нового юзера и сохраняем данные
        $user = new User;
        $user->email = $email;
        $user->password = Hash::make(str_random(60));
        $user->activated = true;

        // если юзер создан успешно, то создаём пустую запись с его дополнительными полями
        if ($user->save()) {
            $description = new User_Description;
            $description->user_id = $user->id;
            $description->first_name = $first_name;
            $description->last_name = $last_name;
            $description->gender = $gender;
            $description->gender_access = 'all';
            $description->save();

            // создаём персональный блог пользователя
            $user->createPersonalBlog();
            
            return $user;
        }
    }
}