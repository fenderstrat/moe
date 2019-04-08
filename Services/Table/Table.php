<?php

namespace Services\Table;

final class Table
{
    private $model;
    private $name;
    private $rows;

    public function model($model): self
    {
        $this->model = $model;
        return $this;
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function show(... $rows): self
    {
        $this->rows = $rows;
        return $this;
    }

    public function render()
    {
        $model = $this->model;
        $name = $this->name;
        $rows = $this->rows;
        if (\Translation::isEnabled()) {
            return view('services.table.multilang', compact('model', 'rows', 'name'));
        }
        return view('services.table.default', compact('model', 'rows', 'name'));
    }
}