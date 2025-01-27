<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Entities;

use PokeDB\PokeApiClient\Entities\Pokemon\LocationAreaEncounter;
use PokeDB\PokeApiClient\Entities\Pokemon\LocationAreaItem;
use PokeDB\PokeApiClient\Field\Field;
use PokeDB\PokeApiClient\Field\FieldType;
use PokeDB\PokeApiClient\Utils\Collection;
use PokeDB\PokeApiClient\Utils\ResourceIdentifier;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;

final class EntityManager
{
    private array $refClasses = [];

    /**
     * @template T of Entity
     *
     * @param  class-string<T>  $entity
     *
     * @phpstan-return T
     *
     * @throws ReflectionException
     */
    public function create(string $entity, array $data): Entity
    {
        // Save Reflection class in-memory for later use
        if (! \array_key_exists($entity, $this->refClasses)) {
            $reflectionClass = new ReflectionClass($entity);
            $this->refClasses[$entity] = $reflectionClass;
        } else {
            $reflectionClass = $this->refClasses[$entity];
        }

        /** @var T $entityInstance */
        $entityInstance = $reflectionClass->newInstanceWithoutConstructor();

        foreach ($reflectionClass->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            /** @var ReflectionAttribute<Field>|null $attr */
            $attr = $property->getAttributes(Field::class)[0] ?? null;
            $name = $property->getName();

            // Get data value via field attribute
            if ($attr) {
                // echo(memory_get_usage(true) / 1024 / 1024) . ' | ';
                $field = $attr->newInstance();
                $value = $field->getParameters($this, $data, $name) ?? $data[$name] ?? null;

                // Special case for NamedApiResource, unset the property so it is uninitialized and can be lazy loaded!
                if ($field->type === FieldType::NAMED_API_RESOURCE) {
                    if (empty($value)) {
                        $property->setValue($entityInstance, null);
                        unset($field, $attr);

                        continue;
                    }

                    $entityInstance->addEndpoint($property->getName(), new ResourceIdentifier($value));
                    unset($entityInstance->{$property->getName()}, $field, $attr);

                    continue;
                }

                $property->setValue($entityInstance, $value);
                unset($field, $attr);

                continue;
            }

            // Special Case for LocationAreaEncounter Entity
            if ($entity === LocationAreaEncounter::class) {
                /** @var Collection<LocationAreaItem> $params */
                $params = new Collection;
                foreach ($data as $item) {
                    $params->add($this->create(LocationAreaItem::class, $item));
                }

                $property->setValue($entityInstance, $params);
                unset($field, $attr);

                continue;
            }

            // If the property is not in the data, unset it
            if (! \array_key_exists($property->getName(), $data)) {
                unset($field, $attr, $entityInstance->{$property->getName()});

                continue;
            }

            // Otherwise, set the property
            $property->setValue($entityInstance, $data[$property->getName()]);
            unset($field, $attr);
        }

        return $entityInstance;
    }
}
