<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FilterBuilder
{
    public function __construct(
        protected Builder $query,
        protected array $filters,
        protected string $folder
    ) {
    }

    public function apply(): Builder
    {
        foreach ($this->filters as $name => $value) {
            $class = $this->resolveClassName($name);

            if (!class_exists($class)) {
                continue;
            }

            $filter = (new $class($this->query));

            if ($value) {
                $filter->handle($value);
            } else {
                $filter->handle();
            }
        }

        return $this->query;
    }

    private function resolveClassName(string $name): string
    {
        $name = ucfirst($name);

        return __NAMESPACE__ . "\\" . $this->folder . "\\" . $name . "Filter";
    }
}
