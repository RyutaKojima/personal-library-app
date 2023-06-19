<?php

declare(strict_types=1);

namespace Packages\Domains\Library;

enum MemberRoleEnum: string
{
    case Member = 'member';
    case Librarian = 'librarian';
    case Owner = 'owner';
}
