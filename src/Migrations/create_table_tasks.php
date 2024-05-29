<?php

namespace Migrations;

use kernel\Migration;

class create_table_tasks extends Migration 
{
    public function up(): void
    {
        $this->exec("CREATE TABLE `tasks` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `list_id` INT NOT NULL,
            `completed` TINYINT DEFAULT 0,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`list_id`) REFERENCES `lists`(`id`)
        )");
    }

    public function down(): void
    {
        $this->exec("DROP TABLE `tasks`");
    }
}