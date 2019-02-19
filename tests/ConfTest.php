<?php
require_once '../src/config/Conf.php';
use PHPUnit\Framework\TestCase;

class ConfTest extends TestCase {
	public function testDatabaseTableAttributes() {
		$c = new Conf();
		$this->assertSame($c->getDatabase(), 'alarconj');
		$this->assertSame($c->getHostname(), 'webinfo');
		$this->assertSame($c->getLogin(), 'alarconj');
		$this->assertSame($c->getpassword(), '0808048000U');
	}
	
	public function testGetLogin(){
		$c = new Conf();
		$this->assertSame($c->getLogin(), 'alarconj');
	}
	
	public function testGetHostName(){
		$c = new Conf();
		$this->assertSame($c->getHostname(), 'webinfo');
	}
	
	public function testGetDataBase(){
		$c = new Conf();
		$this->assertSame($c->getDatabase(), 'alarconj');
	}
	
	public function testGetPassword(){
		$c = new Conf();
		$this->assertSame($c->getpassword(), '0808048000U');
	}
	
	public function testGetDebug(){
		$c = new Conf();
		$this->assertTrue($c->getDebug());
	}
}
?>