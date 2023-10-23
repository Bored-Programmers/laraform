<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Controls;

use BoredProgrammers\LaraForm\Traits\THasView;

class ContainerSection implements IHasChildren
{

    use THasView;

    protected Section $section;

    protected Container $container;

    public static function make(?string $title, array $children = []): static
    {
        $container = new static();
        $container->setView('laraform::components.container-section');
        $container->setContainer(Container::make([]));
        $container->setSection(Section::make([]));
        $container->getSection()->setTitle($title);
        $container->getSection()->setChildren($children);

        $container->getContainer()
            ->addChild($container->getSection());

        return $container;
    }

    public function setContainerHtmlAttribute(string $name, string $value): static
    {
        $this->getContainer()->setHtmlAttribute($name, $value);

        return $this;
    }

    public function setSectionHtmlAttribute(string $name, string $value): static
    {
        $this->getSection()->setHtmlAttribute($name, $value);

        return $this;
    }

    public function getSection(): Section
    {
        return $this->section;
    }

    public function setSection(Section $section): void
    {
        $this->section = $section;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }

    public function getChildren(): array
    {
        return $this->section->getChildren();
    }

    public function addChild(mixed $child): static
    {
        $this->section->addChild($child);

        return $this;
    }

    public function setChildren(array $children): static
    {
        $this->section->setChildren($children);

        return $this;
    }

}
