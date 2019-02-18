<?php
use PHPUnit\Framework\TestCase;

require_once 'src/lib/File.php';

/**
 * File test case.
 */
class FileTest extends TestCase
{

    /**
     *
     * @var File
     */
    private $file;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // TODO Auto-generated FileTest::setUp()

        $this->file = new File(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated FileTest::tearDown()
        $this->file = null;

        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests File::build_path()
     */
    public function testBuild_path()
    {
        // TODO Auto-generated FileTest::testBuild_path()
        $this->markTestIncomplete("build_path test not implemented");

        File::build_path(/* parameters */);
    }
}

