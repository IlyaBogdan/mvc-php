<?php

namespace Migrations;

use kernel\Migration;

class create_table_tasks_2 extends Migration 
{
    public function up(): void
    {
        $this->exec("CREATE TABLE `tasks` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `task_list_id` INT NOT NULL,
            `completed` TINYINT DEFAULT 0,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`task_list_id`) REFERENCES `task_lists`(`id`)
        )");
    }

    public function down(): void
    {
        $this->exec("DROP TABLE `tasks`");
    }
}