<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\InvalidLocaleException;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Resources\Province as ProvinceResource;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

abstract class Controller extends BaseController
{
    /**
     * @var BaseRepositoryInterface $repository
     */
    protected $repository;

    /**
     * Controller constructor.
     *
     * @param BaseRepositoryInterface $repository
     */
    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Check locale to see if it is supported.
     *
     * @param $locale
     * @throws InvalidLocaleException
     */
    protected function checkLocale($locale)
    {
        if (! in_array($locale, ['en', 'fr'])) {
            throw new InvalidLocaleException("Locale '{$locale}' is not supported!", 400);
        }
    }

    /**
     * Get the full name name of a locale.
     *
     * @param $locale
     * @return string
     */
    protected function localeFullName($locale)
    {
        $fullName = [
            'en' => 'English',
            'fr' => 'French'
        ];

        return $fullName[$locale];
    }
}
