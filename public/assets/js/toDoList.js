let lists;

const listsAll = document.querySelector('#userLists');
const listTemplate = document.querySelector('#list');
const taskTemplate = document.querySelector('#task');

const showAll = () => {
    lists.forEach(data => {
        new TaskList(data);
    });
}

class Task {

    constructor(data) {
        const { task_list_id, title, id } = data;
        this.id = id;
        this.listId = task_list_id;
        this.title = title;
        this.completed = data.completed ?? false;
        this.node = taskTemplate.content.cloneNode(true);
    }

    render(parentNode) {
        this.node.querySelector('.task__title').innerText = this.title;
        this.node.querySelector('.task__state input').checked = this.completed;

        this.node.querySelector('.task__state input').addEventListener('change', (e) => {
            const checked = e.target.checked;
            this.changeState(checked);
        })

        parentNode.append(this.node);
    }

    changeState(state) {
        this.completed = state;
        fetch(`/list/${this.listId}/task/${this.id}`, {
            method: 'POST',
            body: JSON.stringify({ completed: state })
        }).then(response => response.json())
          .then((data) => {
            //
        });
    }
}

class TaskList {

    constructor(data) {
        const { id, tasks, title } = data;
        this.id = id;
        this.tasks = tasks.map(taskData => new Task(JSON.parse(taskData)));
        this.title = title;

        this.node = listTemplate.content.cloneNode(true);
        this.titleInput = this.node.querySelector('input[name="title"]');
        this.render();
    }

    render() {
        this.node.querySelector('.list__title').innerText = this.title;
        this.tasks.forEach(task => {
            task.render(this.node.querySelector('.list__tasks'));
        });
        this.node.querySelector('#addTaskSubmit').addEventListener('click', () => { this.addTask() });
        listsAll.append(this.node);
    }

    addTask() {
        const title = this.titleInput.value;
        const data = { task_list_id: this.id, title, completed: false };

        fetch(`/list/${this.id}/task`, {
            method: 'POST',
            body: JSON.stringify(data)
        }).then(response => response.json())
          .then((data) => {
            this.tasks.push(new Task(data));
            this.render();
        });
    }
}

window.onload = () => {
    const body = document.querySelector('body');
    lists = JSON.parse(body.getAttribute('data-lists'));
    showAll();
}