<?php

namespace gift\appli\core\services\catalogue;

interface ICatalogueService
{
    public function getCategories(): array;
    public function getCategorieById(int $id): array;
    public function createCategorie(array $data): int;
}