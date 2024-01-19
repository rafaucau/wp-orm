<?php
/**
 * Copyright (c) 2024 Dimitri BOUTEILLE (https://github.com/dimitriBouteille)
 * See LICENSE.txt for license details.
 *
 * Author: Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 */

namespace Dbout\WpOrm\Models;

use Dbout\WpOrm\Api\OptionInterface;
use Dbout\WpOrm\Builders\OptionBuilder;
use Dbout\WpOrm\Enums\YesNo;
use Dbout\WpOrm\Orm\AbstractModel;

/**
 * @method Option setOptionName(string $name)
 * @method string getOptionName()
 * @method Option setOptionValue($value)
 * @method mixed getOptionValue()
 * @method Option setAutoload(string|YesNo $autoload)
 * @method string getAutoload()
 * @method static static|null find($optionId)
 * @method static OptionBuilder query()
 */
class Option extends AbstractModel implements OptionInterface
{
    /**
     * @inheritDoc
     */
    protected $primaryKey = self::OPTION_ID;

    /**
     * @inheritDoc
     */
    protected $table = 'options';

    /**
     * @inheritDoc
     */
    public $timestamps = false;

    /**
     * @inheritDoc
     */
    public function newEloquentBuilder($query): OptionBuilder
    {
        return new OptionBuilder($query);
    }

    /**
     * @param string $optionName
     * @return self|null
     */
    public static function findOneByName(string $optionName): ?self
    {
        /** @var self|null $result */
        $result = self::query()->firstWhere(self::NAME, $optionName);
        return $result;
    }
}
