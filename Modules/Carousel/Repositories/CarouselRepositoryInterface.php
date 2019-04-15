<?php

namespace Modules\Carousel\Repositories;

interface CarouselRepositoryInterface
{
    public function paginate(array $data);
    public function find(int $id);
    public function findByLanguage(int $id, string $language);
    public function findContent(int $id);
    public function store(array $data);
    public function update(int $id, array $data);
}