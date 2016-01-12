<?php

namespace Cobalt\Model\User;

interface UserMapperInterface
{
    public function getUsers();
    public function getUserById($userId);
    public function getUserBySamAccountName($samAccountName);
    public function persist(UserInterface $user);
    public function count($search = null);
}