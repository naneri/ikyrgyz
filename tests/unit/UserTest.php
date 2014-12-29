<?php

class UserTest extends \Codeception\TestCase\Test
{    

    public function testUserRegistrationEmail(){
        
        $this->assertFalse($this->userValidator('email', null));
                
        $this->assertFalse($this->userValidator('email', ''));
        
        $this->assertFalse($this->userValidator('email', 'naneri'));

        $this->assertFalse($this->userValidator('email', 'naneri@'));

        $this->assertFalse($this->userValidator('email', 'naneri@mail'));

        $this->assertFalse($this->userValidator('email', 'naneri@mail.'));
        
        //return false cause this email exist in database
        $this->assertFalse($this->userValidator('email', 'naneri@mail.ru'));

        $this->assertTrue($this->userValidator('email', 'naneri1@mail.ru'));
        
        $this->assertFalse($this->userValidator('email', '@mail.ru'));
        
        $this->assertFalse($this->userValidator('email', '@mail.ru'));
    }
    
    public function testUserRegistrationPassword(){
        
        $this->assertFalse($this->userValidator('password', null));
        
        $this->assertFalse($this->userValidator('password', ''));
        
        $this->assertFalse($this->userValidator('password', '1'));
        
        $this->assertFalse($this->userValidator('password', '12'));
        
        $this->assertFalse($this->userValidator('password', '123'));
        
        //required 4 symbols, assertion return "true"
        $this->assertTrue($this->userValidator('password', '1234'));
        
    }
    
    public function userValidator($param, $value){
        $validator = Validator::make(array($param => $value), array($param => User::$rules[$param]));
        return $validator->passes();
    }

}