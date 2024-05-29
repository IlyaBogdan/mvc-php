<?php

namespace Migrations;

use kernel\Migration;

class create_table_lists_1 extends Migration 
{
    public function up(): void
    {
        $this->exec("CREATE TABLE `task_lists` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `user_id` INT NOT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (user_id) REFERENCES users(id)
        )");
    }

    public function down(): void
    {
        $this->exec("DROP TABLE `task_lists`");
    }
}