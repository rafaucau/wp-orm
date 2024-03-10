<?php
/**
 * Copyright (c) 2024 Dimitri BOUTEILLE (https://github.com/dimitriBouteille)
 * See LICENSE.txt for license details.
 *
 * Author: Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 */

namespace Dbout\WpOrm\Orm;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    /**
     * @inheritDoc
     */
    protected $guarded = [];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        static::$resolver = new Resolver();
        parent::__construct($attributes);
    }

    /**
     * @inheritDoc
     */
    protected function newBaseQueryBuilder(): Builder
    {
        $connection = $this->getConnection();
        return new Builder(
            $connection,
            $connection->getQueryGrammar(),
            $connection->getPostProcessor()
        );
    }

    /**
     * @inheritDoc
     */
    public function getConnection(): Connection
    {
        return Database::getInstance();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->{$this->primaryKey};
    }

    /**
     * Returns model table name
     *
     * @return string
     * @deprecated Remove in next version
     * @see self::getTable()
     * @see https://stackoverflow.com/a/20812314
     */
    public static function table(): string
    {
        // @phpstan-ignore-next-line
        return (new static())->getTable();
    }

    /**
     * @inheritDoc
     */
    public function __call($method, $parameters)
    {
        preg_match('#^(get|set)(.*)#', $method, $matchGetter);
        if ($matchGetter === []) {
            return parent::__call($method, $parameters);
        }

        $type = $matchGetter[1];
        $attribute = $matchGetter[2];
        $attribute = strtolower((string)preg_replace('/(?<!^)[A-Z]/', '_$0', $attribute));

        if ($type === 'get') {
            return $this->getAttribute($attribute);
        }

        $this->setAttribute($attribute, ...$parameters);
        return $this;
    }
}
