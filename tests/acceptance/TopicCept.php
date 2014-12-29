<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Create topic');
$I->amOnPage('/login');
$I->fillField('email', 'naneri@mail.ru');
$I->fillField('password', '104430');
$I->click('Go!');
$I->click('Create');
$I->click('Topic');
$I->fillField('title', 'test title');
$I->click('Publish');
$I->see('test title');
