<?php

namespace TorneLIB\Exception;

abstract class Constants
{
    /** @var int No error constant. For testing purposes. */
    const LIB_NO_ERROR = 0;

    /** @var int All unhandled error codes unless we choose to transform into HTTP return codes. */
    const LIB_UNHANDLED = 65535;

    /** @var int Invalid URL. */
    const LIB_INVALID_URL = 1002;

    /** @var int Usually thrown when there's no URL present. */
    const LIB_EMPTY_URL = 1002;
}