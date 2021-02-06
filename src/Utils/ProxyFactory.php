<?php

declare(strict_types=1);

namespace PokeDB\PokeApiClient\Utils;

use Closure;
use PokeDB\PokeApiClient\Definitions\EntityDefinition;
use PokeDB\PokeApiClient\Entities\Entity;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use ProxyManager\Proxy\LazyLoadingInterface;
use ProxyManager\Proxy\VirtualProxyInterface;

/**
 * Proxy Factory.
 */
trait ProxyFactory
{
    /**
     * Create a Entity Proxy
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @psalm-template RealObjectType of Entity
     * @psalm-return RealObjectType&\ProxyManager\Proxy\ValueHolderInterface<RealObjectType>&VirtualProxyInterface
     * @psalm-suppress MissingClosureParamType
     *
     * @param EntityDefinition $definition
     * @param string $identifier
     * @return VirtualProxyInterface|Entity
     */
    public function createProxy(EntityDefinition $definition, string $identifier): VirtualProxyInterface
    {
        return (new LazyLoadingValueHolderFactory())->createProxy(
            $definition->getEntityClass(),
            function (
                &$wrappedObject,
                LazyLoadingInterface $proxy,
                string $method,
                array $parameters,
                ?Closure &$initializer
            ) use (
                $definition,
                $identifier
            ): bool {
                $response = $definition->getClient()->sendRequest($definition, $identifier);
                $initializer   = null; // disable initialization
                $wrappedObject = $response; // fill your object with values here

                return true; // confirm that initialization occurred correctly
            }
        );
    }
}
