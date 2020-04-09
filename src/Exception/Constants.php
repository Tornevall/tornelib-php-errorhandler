<?php

namespace TorneLIB\Exception;

abstract class Constants
{
    /**
     * A "this is not an error" constant. For testing purposes. Everything should have an error code
     * so if this code ever occurs except for during tests, something went wrong.
     * @var int
     */
    const LIB_NO_ERROR = 0;

    /**
     * All unhandled error codes unless we choose to transform into HTTP return codes.
     * @var int
     */
    const LIB_UNHANDLED = 65535;

    /**
     * Library detected an invalid URL.
     * @var int
     */
    const LIB_INVALID_URL = 1002;

    /**
     * Usually thrown when there's no URL present.
     * @var int
     */
    const LIB_EMPTY_URL = 1003;

    /**
     * When trying to fetch headers from a curl session that is based on multiple requests, correct url must also be specifed.
     * @var int
     */
    const LIB_MULTI_HEADER = 1004;

    /**
     * Normally thrown from a magic when variables are not set.
     * @var int
     */
    const LIB_CONFIGWRAPPER_VAR_NOT_SET = 1005;

    /**
     * Thrown when phpUtils tries to (ini)set memory limit and is not allowed to.
     * @var int
     */
    const LIB_UTILS_MEMORY_FAILSET = 1006;
}
