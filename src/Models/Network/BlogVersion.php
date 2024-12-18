<?php
/**
 * Copyright © Dimitri BOUTEILLE (https://github.com/dimitriBouteille)
 * See LICENSE.txt for license details.
 *
 * Author: Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 */

namespace Dbout\WpOrm\Models\Network;

use Carbon\Carbon;
use Dbout\WpOrm\Orm\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $blog_id
 * @property string $db_version
 * @property Carbon $last_updated
 *
 * @property-read Blog $blog
 */
class BlogVersion extends AbstractModel
{
    public const CREATED_AT = null;
    public const UPDATED_AT = self::LAST_UPDATED;
    final public const BLOG_ID = 'blog_id';
    final public const DB_VERSION = 'db_version';
    final public const LAST_UPDATED = 'last_updated';

    protected bool $useBasePrefix = true;

    protected $table = 'blog_versions';

    protected $primaryKey = self::BLOG_ID;

    protected $casts = [
        self::LAST_UPDATED => 'datetime',
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class, self::BLOG_ID);
    }
}