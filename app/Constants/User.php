<?php

namespace App\Constants;

final class User
{
    public const TABLE_NAME = 'users';
    public const ID = Model::ID;
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const CATEGORY = 'category';
    public const UF = 'uf';
    public const CPF = 'cpf';
    public const ADDRESS = 'address';
    public const COMPANY = 'company';
    public const PHONE = 'phone';
    public const TELEPHONE = 'telephone';
    public const ROLE = 'role';
    public const PASSWORD = 'password';

    public const ROLES = ['admin', 'operator', 'student'];


    public const CATEGORIES = ['student', 'professional', 'associate'];
}
