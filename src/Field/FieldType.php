<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Field;

enum FieldType
{
    case STRING;
    case NUMBER;
    case BOOLEAN;
    case COLLECTION;
    case TRANSLATION;
    case NAMED_API_RESOURCE;
    case NAMED_API_RESOURCE_LIST;
}
