<?php

namespace gift\api\core\services\box;

interface IBoxService
{
    public function getPrestations(): array;
    public function getPrestationById(string $id): array;
    public function updatePrestation(array $data): void;
    public function updateIdCategorieOfPrestation(string $presta_id, int $categ_id): void;
    public function getBoxById(string $id): array;
    public function createBox(array $data): string;
    public function addPrestationToBox(string $presta_id, string $box_id): void;
}