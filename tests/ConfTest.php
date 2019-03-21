<?php
use PHPUnit\Framework\TestCase;

include '../src/config/Conf.php';

class ConfTest extends TestCase
{

    public function testDatabaseTableAttributes()
    {
        $c = new Conf();
        self::assertSame($c->getDatabase(), 'alarconj');
        self::assertSame($c->getHostname(), 'webinfo.iutmontp.univ-montp2.fr');
        self::assertSame($c->getLogin(), 'alarconj');
        self::assertSame($c->getpassword(), '0808048000U');
    }

    public function testGetLogin()
    {
        $c = new Conf();
        self::assertSame($c->getLogin(), 'alarconj');
    }

    public function testGetHostName()
    {
        $c = new Conf();
        self::assertSame($c->getHostname(), 'webinfo.iutmontp.univ-montp2.fr');
    }

    public function testGetDataBase()
    {
        $c = new Conf();
        self::assertSame($c->getDatabase(), 'alarconj');
    }

    public function testGetPassword()
    {
        $c = new Conf();
        self::assertSame($c->getpassword(), '0808048000U');
    }

    public function testGetDebug()
    {
        $c = new Conf();
        self::assertTrue($c->getDebug());
    }
}
?>