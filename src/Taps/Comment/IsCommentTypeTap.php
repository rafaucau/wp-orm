<?php
/**
 * Copyright (c) 2024 Dimitri BOUTEILLE (https://github.com/dimitriBouteille)
 * See LICENSE.txt for license details.
 *
 * Author: Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 */

namespace Dbout\WpOrm\Taps\Comment;

use Dbout\WpOrm\Builders\CommentBuilder;
use Dbout\WpOrm\Models\Comment;

readonly class IsCommentTypeTap
{
    /**
     * @param string $commentType
     */
    public function __construct(
        protected string $commentType
    ) {
    }

    /**
     * @param CommentBuilder $builder
     * @return void
     */
    public function __invoke(CommentBuilder $builder): void
    {
        $builder->where(Comment::TYPE, $this->commentType);
    }
}
