Hello {{$user->email}}, <br><br>

Please activate your account with the link provided below: 

{{URL::to('activate/' . $user->activation_code)}}