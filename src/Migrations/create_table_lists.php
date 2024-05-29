<?php

namespace Migrations;

use kernel\Migration;

class create_table_lists extends Migration 
{
    public function up(): void
    {
        $this->exec("CREATE TABLE `lists` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `user_id` INT NOT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (user_id) REFERENCES users(id)
        )");
    }

    public function down(): void
    {
        $this->exec("DROP TABLE `lists`");
    }
}