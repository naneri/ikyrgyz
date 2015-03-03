<?php

class ExampleTest extends TestCase {


	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testIndexPage()
	{
		$crawler = $this->call('GET', '/');
		$this->assertTrue($this->client->getResponse()->isOk());
	}

	public function testIndexPageAfterAuth(){
		$this->be(User::find(1));
		$crawler = $this->call('GET', '/');
		$this->assertRedirectedTo('main/index');
	}

	public function testMainPage(){
		parent::setUp();
		$this->be(User::find(1));
		$crawler = $this->call('GET', 'main/index');
		$this->assertViewHas(['topics', 'base_config']);
	}
}
