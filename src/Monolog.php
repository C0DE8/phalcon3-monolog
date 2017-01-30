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
    * @var
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
     * Sets the message formatter
     *
     * @param \Phalcon\Logger\FormatterInterface $formatter
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function setFormatter(FormatterInterface $formatter)
    {

    }

    /**
     *
     */
    public function getFormatter()
    {

    }

    /**
     * Filters the logs sent to the handlers that are less or equal than a specific level
     *
     * @param int $level
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function setLogLevel($level = PhalconLogger::INFO)
    {

    }

    /**
     * Returns the current log level
     *
     * @return int
     */
    public function getLogLevel()
    {

    }

    /**
     * Logs messages to the internal logger. Appends logs to the logger
     *
     * @param mixed $type
     * @param mixed $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function log($type, $message = null, array $context = array())
    {
        if ($message == null) {
            $message = $type;
            $type    = PhalconLogger::INFO;
        }
        $this->_monolog->addRecord($this->levelMapping[$type], $message, $context);
        return $this;
    }

    /**
     * Starts a transaction
     *
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function begin()
    {
        return $this;
    }

    /**
     * Commits the internal transaction
     *
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function commit()
    {
        return $this;
    }

    /**
     * Rollbacks the internal transaction
     *
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function rollback()
    {
        return $this;
    }

    /**
     * Closes the logger
     *
     * @return bool
     */
    public function close()
    {
        return true;
    }

    /**
     * Sends/Writes a debug message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function debug($message, array $context = array())
    {
        $this->_monolog->addDebug($message, $context);
        return $this;
    }

    /**
     * Sends/Writes an error message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function error($message, array $context  = array())
    {
        $this->_monolog->addError($message, $context);
        return $this;
    }

    /**
     * Sends/Writes an info message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function info($message, array $context = array())
    {
        $this->_monolog->addInfo($message, $context);
        return $this;
    }

    /**
     * Sends/Writes a notice message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function notice($message, array $context = array())
    {
        $this->_monolog->addNotice($message, $context);
        return $this;
    }

    /**
     * Sends/Writes a warning message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function warning($message, array $context = array())
    {
        $this->_monolog->addWarning($message, $context);
        return $this;
    }

    /**
     * Sends/Writes an alert message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function alert($message, array $context = array())
    {
        $this->_monolog->addAlert($message, $context);
        return $this;
    }

    /**
     * Sends/Writes an emergency message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function emergency($message, array $context = array())
    {
        $this->_monolog->addEmergency($message, $context);
        return $this;
    }

}
