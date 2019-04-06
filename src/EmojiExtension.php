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

use League\CommonMark\Extension\Extension;

/**
 * This is the emoji extension class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class EmojiExtension extends Extension
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
     * Returns a list of inline parsers to add to the existing list.
     *
     * @return \League\CommonMark\Inline\Parser\InlineParserInterface[]
     */
    public function getInlineParsers()
    {
        return [$this->parser];
    }
}
