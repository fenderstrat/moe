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

    public function actions(... $actions): self
    {
        $this->actions = array_intersect($actions, Filter::all());
        return $this;
    }

    public function render()
    {
        $model = $this->model;
        $name = $this->name;
        $rows = $this->rows;
        $toolbar = $this->actions;
        return view('services.table.index', compact('model', 'rows', 'name', 'toolbar'));
    }
}