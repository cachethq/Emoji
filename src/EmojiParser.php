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

use CachetHQ\Emoji\Repositories\RepositoryInterface;
use League\CommonMark\Inline\Element\Image;
use League\CommonMark\Inline\Parser\InlineParserInterface;
use League\CommonMark\InlineParserContext;

/**
 * This is the emoji parser class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author James Brooks <james@alt-three.com>
 */
class EmojiParser implements InlineParserInterface
{
    /**
     * The emoji repo.
     *
     * @var \CachetHQ\Emoji\Repositories\RepositoryInterface
     */
    protected $repo;

    /**
     * The emoji mappings.
     *
     * @var string[]|null
     */
    protected $map;

    /**
     * Create a new emoji parser instance.
     *
     * @param \CachetHQ\Emoji\Repositories\RepositoryInterface $repo
     *
     * @return void
     */
    public function __construct(RepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return string[]
     */
    public function getCharacters(): array
    {
        return [':'];
    }

    /**
     * Parse a line and determine if it contains an emoji.
     *
     * If it does, then we do the necessary.
     *
     * @param \League\CommonMark\InlineParserContext $inlineContext
     *
     * @throws \CachetHQ\Emoji\Exceptions\FetchException
     *
     * @return bool
     */
    public function parse(InlineParserContext $inlineContext): bool
    {
        $cursor = $inlineContext->getCursor();

        $saved = $cursor->saveState();

        $cursor->advance();

        $handle = $cursor->match('/^[a-z0-9\+\-_]+:/');

        if (!$handle) {
            $cursor->restoreState($saved);

            return false;
        }

        $key = substr($handle, 0, -1);

        if ($this->map === null) {
            $this->map = $this->repo->get();
        }

        if (!array_key_exists($key, $this->map)) {
            $cursor->restoreState($saved);

            return false;
        }

        $inline = new Image($this->map[$key], $key);
        $inline->data['attributes'] = ['class' => 'emoji', 'data-emoji' => $key];
        $inlineContext->getContainer()->appendChild($inline);

        return true;
    }
}
