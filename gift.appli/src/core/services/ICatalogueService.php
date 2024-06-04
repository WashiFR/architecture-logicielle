<?php

namespace gift\appli\core\services;

interface ICatalogueService
{
    public function getCategories(): array;
    public function getCategorieById(int $id): array;
    public function getPrestations(): array;
    public function getPrestationById(string $id): array;
}