<?php

declare(strict_types=1);

namespace App\CartSortStrategies\Merge;

use Exception;

class PathSorter
{

    protected array $byStartCache = [];
    protected array $byEndCache = [];
    protected array $pathCollection = [];

    public function getShortedPath(): Path
    {
        if (count($this->pathCollection) > 1) {
            throw new Exception('Invalid cart collection');
        }

        return $this->pathCollection[array_key_first($this->pathCollection)];
    }

    public function add(Path $path) {
        $connectedToPathId = $this->connect($path);
        while ($connectedToPathId) {
            $connectedToPathId = $this->connect($this->pathCollection[$connectedToPathId]);

        }
    }

    //return null in case no elements to connect path, return connected path id otherwise
    protected function connect(Path $path): ?string
    {
        $endConnectedPathId = $this->tryConnectToEnd($path);
        if ($endConnectedPathId) {
            return $endConnectedPathId;
        }

        $startConnectedPathId = $this->tryConnectToStart($path);
        if ($startConnectedPathId) {
            return $startConnectedPathId;
        }

        if (empty($path->getId())) {
            $id = $this->insertPath($path);
            $this->byStartCache[$path->getStart()] = $id;
            $this->byEndCache[$path->getEnd()] = $id;

        }

        return null;
    }

    protected function tryConnectToEnd(Path $path): ?string
    {
        $start = $path->getStart();
        $end = $path->getEnd();

        if (!empty($this->byEndCache[$start])) {
            $id = $this->byEndCache[$start];
            $basePath = $this->pathCollection[$id];
            /** @var Path $basePath */
            $basePath->addToEnd($path);
            unset($this->byEndCache[$start]);
            $this->byEndCache[$end] = $id;
            $this->rmPath($path);

            return $id;
        }

        return null;
    }

    protected function tryConnectToStart(Path $path): ?string
    {
        $start = $path->getStart();
        $end = $path->getEnd();

        if (!empty($this->byStartCache[$end])) {
            $id = $this->byStartCache[$end];
            $basePath = $this->pathCollection[$id];

            /** @var Path $basePath */
            $basePath->addToStart($path);

            unset($this->byStartCache[$end]);
            $this->byStartCache[$start] = $id;
            $this->rmPath($path);

            return $id;
        }

        return null;
    }

    protected function rmPath(Path $path): void
    {
        $id = $path->getId();
        if (array_key_exists($id, $this->pathCollection)) {
            unset($this->pathCollection[$id]);
        }
    }

    protected function insertPath(Path $path): string
    {
        $id = uniqid();
        $this->pathCollection[$id] = $path;
        $path->setId($id);

        return $id;
    }

}
