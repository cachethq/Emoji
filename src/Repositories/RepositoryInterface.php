<?php

declare(strict_types=1);

/*
 * This file is part of Cachet Emoji.
 *
 * (c) apilayer GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Emoji\Repositories;

/**
 * This is the emoji repository interface.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
interface RepositoryInterface
{
    /**
     * Fetch the emoji map.
     *
     * @throws \CachetHQ\Emoji\Exceptions\FetchException
     *
     * @return array
     */
    public function get();
}
