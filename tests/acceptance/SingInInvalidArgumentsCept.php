<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('log in as invalid user');
$I->amOnPage('/logout');
$I->amOnPage('/login');
$I->fillField('email', 'eri@mail.ru');
$I->fillField('password', '104430');
$I->click('Go!');
$I->see('Invalid credentials provided');