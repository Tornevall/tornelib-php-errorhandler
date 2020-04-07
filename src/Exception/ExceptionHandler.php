<?php

namespace TorneLIB\Exception;

class ExceptionHandler extends \Exception
{

    public function __construct(
        $message = 'Unknown exception',
        $code = 0,
        \Exception $previous = null,
        $stringifiedCode = null,
        $fromFunction = ''
    ) {
        if (!$code) {
            if (!defined('LIB_ERROR_HTTP')) {
                // Use internal error.
                $code = Constants::LIB_UNHANDLED;
            } else {
                // Use bad request when unknown and LIB_ERROR_HTTP is enabled.
                $code = 400;
            }
        } else {
            if (!empty($code) && is_string($code)) {
                $code = $this->getConstantedValue($code);
            }
        }

        parent::__construct($message, $code, $previous);
        $this->traceFunction = $fromFunction;
        $this->stringifiedCode = $stringifiedCode;
        $this->setStringifiedCode();
    }

    private function getConstantedValue($code)
    {
        // Make it possible to push a stringified code into this exceptionhandler.
        $numericConstant = @constant(sprintf('TorneLIB\Exception\Constants::%s', $code));
        if ($numericConstant) {
            $code = $numericConstant;
        } else {
            if (!defined('LIB_ERROR_HTTP')) {
                // Use internal error.
                $code = Constants::LIB_UNHANDLED;
            } else {
                // Use bad request when unknown and LIB_ERROR_HTTP is enabled.
                $code = 400;
            }
        }

        return $code;
    }

    /**
     *
     */
    private function setStringifiedCode()
    {
        if (empty($this->code) && !empty($this->stringifiedCode)) {
            try {
                $constant = constant('CONSTANTS::' . $this->stringifiedCode);
            } catch (\Exception $regularConstantException) {
                // Ignore this.
            }
            if (!empty($constant)) {
                $this->code = constant('CONSTANTS::' . $this->stringifiedCode);
            } else {
                $this->code = $this->stringifiedCode;
            }
        }
    }

    public function __toString()
    {
        if (empty($this->traceFunction)) {
            return "Exception: [{$this->code}]: {$this->message}";
        } else {
            return "{$this->traceFunction}Exception {$this->code}: {$this->message}";
        }
    }

    /**
     * @return |null
     */
    public function getStringifiedCode()
    {
        return $this->stringifiedCode;
    }

    /**
     * @return string
     */
    public function getTraceFunction()
    {
        return $this->traceFunction;
    }
}
