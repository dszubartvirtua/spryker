<?php

namespace Pyz\Zed\AntelopeLocationSearch;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class AntelopeLocationSearchConfig extends AbstractBundleConfig
{
    public const ANTELOPE_LOCATION_PUBLISH_SEARCH_QUEUE = 'publish.search.antelope_location';
    public const ANTELOPE_LOCATION_SYNC_SEARCH_QUEUE = 'sync.search.antelope_location';
    public const ENTITY_PYZ_ANTELOPE_LOCATION_CREATE = 'Entity.pyz_antelope_location.create';
    public const ENTITY_PYZ_ANTELOPE_LOCATION_UPDATE = 'Entity.pyz_antelope_location.update';
    public const ENTITY_PYZ_ANTELOPE_LOCATION_DELETE = 'Entity.pyz_antelope_location.delete';
    public const ANTELOPE_LOCATION_PUBLISH = 'AntelopeSearch.antelope_location.publish';
    public const ANTELOPE_LOCATION_UNPUBLISH = 'AntelopeSearch.antelope_location.unpublish';
}
