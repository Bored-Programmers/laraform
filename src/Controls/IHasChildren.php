<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Controls;

interface IHasChildren
{

    public function getChildren(): array;

    public function setChildren(array $children): static;

}
