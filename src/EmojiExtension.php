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

namespace CachetHQ\Emoji;

use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;

/**
 * This is the emoji extension class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author James Brooks <james@alt-three.com>
 */
class EmojiExtension implements ExtensionInterface
{
    /**
     * The emoji parser.
     *
     * @var \CachetHQ\Emoji\EmojiParser
     */
    protected $parser;

    /**
     * Create a new emoji parser instance.
     *
     * @param \CachetHQ\Emoji\EmojiParser $parser
     *
     * @return void
     */
    public function __construct(EmojiParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Register extensions.
     *
     * @return void
     */
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addInlineParser($this->parser);
    }
}
