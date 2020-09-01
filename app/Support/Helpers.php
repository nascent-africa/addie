<?php


namespace App\Support;


class Helpers
{
    /**
     * Cache time.
     *
     * @var int
     */
    public const CACHE_TIME = 3600;

    /**
     * Message on successful record creation.
     *
     * @param string|null $message
     * @return string
     */
    public static function createdSuccess(string $message = null): string
    {
        if ($message) {
            return __($message);
        }
        return __('Record created successfully!');
    }

    /**
     * Message on successful record update.
     *
     * @param string|null $message
     * @return string
     */
    public static function updatedSuccess(string $message = null): string
    {
        if ($message) {
            return __($message);
        }
        return __('Record updated successfully!');
    }

    /**
     * Message on successful record deletion.
     *
     * @param string|null $message
     * @return string
     */
    public static function deletedSuccess(string $message = null): string
    {
        if ($message) {
            return __($message);
        }
        return __('Record deleted successfully!');
    }
}
