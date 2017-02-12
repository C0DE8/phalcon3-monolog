<?php

namespace C0DE8\Phalcon\Logger\Adapter;

use Monolog\Logger as MonologLogger;

use Phalcon\Logger as PhalconLogger;
use Phalcon\Logger\Adapter;
use Phalcon\Logger\FormatterInterface;
use Phalcon\Logger\Formatter\Line as LineFormatter;

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
    protected $levelMapping = [
        PhalconLogger::DEBUG    => MonologLogger::DEBUG,
        PhalconLogger::INFO     => MonologLogger::INFO,
        PhalconLogger::NOTICE   => MonologLogger::NOTICE,
        PhalconLogger::WARNING  => MonologLogger::WARNING,
        PhalconLogger::ERROR    => MonologLogger::ERROR,
        PhalconLogger::ALERT    => MonologLogger::ALERT,
        PhalconLogger::EMERGENCY=> MonologLogger::EMERGENCY
    ];


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
        if (!$this->_formatter) {
            $this->_formatter = new LineFormatter();
        }
        return $this->_formatter;
    }

    /**
     * closes the logger
     */
    public function close()
    {
        // nothing to do here, will return null (implicitly)
    }

    /**
     * Logs messages to the internal logger. Appends logs to the monolog logger.
     *
     * @param  string  $message
     * @param  int     $type
     * @param  int     $time
     * @param  array   $context
     * @return Monolog
     */
    public function logInternal(
        string $message,
        int    $type,
        int    $time,
        array  $context = null
    ) : Monolog {
        $this->_monolog->addRecord($this->levelMapping[$type], $message, $context);
        return $this;
    }
}
