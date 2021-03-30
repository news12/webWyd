<?php

namespace App\Repositories\Contract;

interface CharacterRepositoryInterface
{

    public function getCharacter($field = ['*'], $where = [null]);
    public function getOneCharacter($field = ['*'],$where = [null]);
    public function all();

}