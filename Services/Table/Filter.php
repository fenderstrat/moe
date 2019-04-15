<?php

namespace Services\Table;

final class Filter
{
    const DESTROY = 'destroy';
    const TRASH = 'trash';
    const DRAFT = 'draft';
    const PUBLISH = 'publish';
    const SORT = 'sort';
    const SEARCH = 'search';

    public static function all(): array
    {
        return [
            self::DESTROY,
            self::TRASH,
            self::DRAFT,
            self::PUBLISH,
            self::SORT,
            self::SEARCH
        ];
    }

    public static function buttons(): array
    {
        return [
            self::DESTROY,
            self::TRASH,
            self::DRAFT,
            self::PUBLISH
        ];
    }
}