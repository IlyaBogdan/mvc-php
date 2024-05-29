<?php

namespace Migrations;

use kernel\Migration;

class init_migration_0 extends Migration 
{
    public function up(): void
    {
        $this->exec("CREATE TABLE `users` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id`)
        )");
    }

    public function down(): void
    {
        $this->exec("DROP TABLE `users`");
    }
}