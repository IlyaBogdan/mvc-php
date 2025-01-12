<?php
    $result = [];

    foreach ($lists as $list) {
        $result[] = array_merge(
            $list->__serialize(),
            ['tasks' => array_map(fn($task) => json_encode($task->__serialize()), $list->tasks())]
        );
    }

    $lists = htmlentities(json_encode($result));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body data-lists="<?= $lists ?>">
    
    <div class="container">
        <div id="userLists"></div>
        <div id="newList">
            <div class="newList-form">
                <div class="newList-form__title">Create new Task List</div>
                <div class="newList-form__inputs">
                    <label for="title">Title</label>
                    <input type="text" name="title">
                    <input type="number" name="user_id" hidden value="<?= $_SESSION['user_id'] ?>">
                </div>
                <div class="newList-form__buttons">
                    <button id="newListAdd" class="btn submit">Submit</button>
                    <button id="newListCancel" class="btn cancel">Cancel</button>
                </div>
            </div>
            <div>
                <button id="newListOpenForm" class="btn primary">New List</button>
            </div>
        </div>
    </div>

    <template id="list">
        <div class="list">
            <div class="list__title"></div>
            <div class="list__tasks"></div>

            <div class="task-form">
                <div class="task-form__input">
                    <label for="title">Title</label>
                    <input type="text" name="title">
                </div>
                <div>
                    <button id="addTaskSubmit" class="btn primary" type="button">Submit</button>
                </div>
                
            </div>
            
        </div>
    </template>

    <template id="task">
        <div class="task">
            <div class="task__title"></div>
            <div class="task__state">
                <input type="checkbox">
            </div>
        </div>
    </template>

    <script src="/assets/js/toDoList.js"></script>
</body>
</html>