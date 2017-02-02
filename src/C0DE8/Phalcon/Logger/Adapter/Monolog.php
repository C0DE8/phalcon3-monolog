<?php

namespace C0DE8\Phalcon\Logger\Adapter;

use Monolog\Logger as MonologLogger;

use Phalcon\Logger as PhalconLogger;
use Phalcon\Logger\Adapter;
use Phalcon\Logger\FormatterInterface;

/**
 * Class Monolog
 * @package C0DE8\Phalcon\Logger\Adapter
 */
class Monolog extends Adapter
{

    /**
    * @var MonologLogger
    */
    protected $_monolog;

    /**
     * @var array
     */
    protected $levelMapping = array(
        PhalconLogger::DEBUG    => MonologLogger::DEBUG,
        PhalconLogger::INFO     => MonologLogger::INFO,
        PhalconLogger::NOTICE   => MonologLogger::NOTICE,
        PhalconLogger::WARNING  => MonologLogger::WARNING,
        PhalconLogger::ERROR    => MonologLogger::ERROR,
        PhalconLogger::ALERT    => MonologLogger::ALERT,
        PhalconLogger::EMERGENCY=> MonologLogger::EMERGENCY
    );


    /**
     * MonologAdapter constructor.
     * @param MonologLogger $monolog
     */
    public function __construct(MonologLogger $monolog)
    {
        $this->_monolog = $monolog;
    }

    /**
     * @return MonologLogger
     */
    public function getMonologLoggerInstance() : MonologLogger
    {
        return $this->_monolog;
    }

    /**
     * returns the internal formatter
     */
    public function getFormatter() : FormatterInterface
    {
        // no formatter needed, work will done in monolog
        // should not be called, because no monolog formatter available
    }

    /**
     * closes the logger
     */
    public function close()
    {
        // nothing to do here
    }

    /**
     * Logs messages to the internal logger. Appends logs to the logger
     *
     * @param string $message
     * @param int    $type
     * @param int    $time
     * @param array  $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function logInternal(string $message, int $type, int $time, array $context = array())
    {
        $this->_monolog->addRecord($this->levelMapping[$type], $message, $context);
    }

}
