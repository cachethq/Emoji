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

namespace CachetHQ\Tests\Emoji\Exceptions;

use CachetHQ\Emoji\Exceptions\EmojiExceptionInterface;
use CachetHQ\Emoji\Exceptions\FetchException;
use Exception;
use LogicException;
use PHPUnit\Framework\TestCase;

/**
 * This is the fetch exception test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class FetchExceptionTest extends TestCase
{
    public function testConstruct()
    {
        $p = new LogicException('Oh no!');
        $e = new FetchException($p);

        $this->assertInstanceOf(Exception::class, $e);
        $this->assertInstanceOf(EmojiExceptionInterface::class, $e);

        $this->assertSame('Failed to fetch the emoji map.', $e->getMessage());
        $this->assertSame(0, $e->getCode());
        $this->assertSame($p, $e->getPrevious());
    }
}
