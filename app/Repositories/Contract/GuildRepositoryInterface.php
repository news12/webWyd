<?php

namespace App\Repositories\Contract;

interface GuildRepositoryInterface
{

    public function getGuild($field = ['*'], $where = [null]);
    public function getMember($field = ['*'], $where = [null]);
    public function all_n($table, $fields = ['*']);
    public function all();
    public function createMember($field = [null]);
    public function memberInOut($field = [null]);
    public function createDonate($field = [null]);

}