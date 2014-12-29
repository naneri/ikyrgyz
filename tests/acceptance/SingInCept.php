<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('log in as regular user');
$I->amOnPage('/login');
$I->fillField('email', 'naneri@mail.ru');
$I->fillField('password', '104430');
$I->click('Go!');
$I->see('I-Kyrgyz');
$I->seeCurrentUrlEquals('/main/index');