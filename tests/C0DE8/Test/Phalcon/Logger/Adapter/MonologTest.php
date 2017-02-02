<?php

namespace C0DE8\Test\Phalcon\Logger\Adapter;

use PHPUnit\Framework\TestCase;
use Monolog\Logger as MonologLogger;
use C0DE8\Phalcon\Logger\Adapter\Monolog;
use Phalcon\Logger\Formatter\Line as LineFormatter;


/**
 * Class MonologTest
 */
class MonologTest extends TestCase
{

    /**
     * @var MonologLogger
     */
    protected $_monologLoggerMock;


    /**
     * setUp - called before every test
     */
    protected function setUp()
    {
        // create a stub for the Monolog Logger class.
        $this->_monologLoggerMock = $this->createMock(MonologLogger::class);
    }

    /**
     * tearDown - executd after each test
     */
    protected function tearDown()
    {
        $this->_monologLoggerMock = null;
    }


    /**
     * test that the injected MonologLogger instance is the same as we get
     * from the method "getMonologLoggerInstance"
     */
    public function testMonologLoggerInstanceIsUsed()
    {
        $this->assertTrue($this->_monologLoggerMock instanceof MonologLogger);

        $monologAdapter = new Monolog($this->_monologLoggerMock);

        $this->assertInstanceOf(MonologLogger::class, $this->_monologLoggerMock);
        $this->assertSame($monologAdapter->getMonologLoggerInstance(), $this->_monologLoggerMock);
    }

    /**
     * data provider
     */
    public function dataProviderLogLevelMethods() : array
    {
        return [
            [ 'debug'    , 'a debug message'     , [1,2,3], MonologLogger::DEBUG     ],
            [ 'info'     , 'an info message'     , [4,5,6], MonologLogger::INFO      ],
            [ 'notice'   , 'a notice message'    , [9,8,7], MonologLogger::NOTICE    ],
            [ 'warning'  , 'a warning message'   , [6,5,4], MonologLogger::WARNING   ],
            [ 'error'    , 'an error message'    , [7,2,5], MonologLogger::ERROR     ],
            [ 'alert'    , 'an alert message'    , [1,8,4], MonologLogger::ALERT     ],
            [ 'emergency', 'an emergency message', [8,8,8], MonologLogger::EMERGENCY ]
        ];
    }

    /**
     * @dataProvider dataProviderLogLevelMethods
     *
     * @param string $method
     * @param string $message
     * @param array  $context
     * @param int    $expectedMonologLogLevel
     */
    public function testMonologAdapterLogLevelMethodsToMonologLoggerLevels(
        string $method,
        string $message,
        array  $context,
        int    $expectedMonologLogLevel
    ) {
        // configure the monolog logger stub
        $this->_monologLoggerMock->method('addRecord')
             ->with(
                 $this->equalTo($expectedMonologLogLevel),
                 $this->equalTo($message),
                 $this->equalTo($context)
             )
             ->willReturn(true); // return value is not used

        $monologAdapter = new Monolog($this->_monologLoggerMock);
        $monologAdapter->$method($message, $context);
    }

    /**
     * test, that getFormatter method returns a LineFormatter
     */
    public function testGetFormatterReturnsALineFormatter()
    {
        $monologAdapter = new Monolog($this->_monologLoggerMock);
        $this->assertInstanceOf(LineFormatter::class, $monologAdapter->getFormatter());
    }

    /**
     * test, that close method returns NULL
     */
    public function testCloseReturnsNull()
    {
        $monologAdapter = new Monolog($this->_monologLoggerMock);
        $this->assertNull($monologAdapter->close());
    }

}
