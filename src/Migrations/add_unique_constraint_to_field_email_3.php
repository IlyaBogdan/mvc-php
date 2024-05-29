<?php

namespace Migrations;

use kernel\Migration;

class add_unique_constraint_to_field_email_3 extends Migration 
{
    public function up(): void
    {
        $this->exec("CREATE UNIQUE INDEX `unique_user_email` ON `users`(`email`)");
    }

    public function down(): void
    {
        $this->exec("ALTER TABLE `users` DROP INDEX `unique_user_email`");
    }
}