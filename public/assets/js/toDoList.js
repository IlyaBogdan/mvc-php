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

        this.titleElement = this.node.querySelector('.task__title');
        this.stateInput = this.node.querySelector('.task__state input');
    }

    render(parentNode) {
        this.titleElement.innerText = this.title;
        this.stateInput.checked = this.completed;

        if (this.completed) this.titleElement.style.textDecoration = 'line-through';

        this.stateInput.addEventListener('change', (e) => {
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
            if (data.completed) this.titleElement.style.textDecoration = 'line-through';
            else this.titleElement.style.textDecoration = 'none';
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
        this.node.querySelector('#addTaskSubmit').addEventListener('click', (e) => { this.addTask(e) });
        listsAll.append(this.node);
    }

    addTask(e) {
        const title = this.titleInput.value;
        const data = { task_list_id: this.id, title, completed: false };

        fetch(`/list/${this.id}/task`, {
            method: 'POST',
            body: JSON.stringify(data)
        }).then(response => response.json())
          .then((data) => {
            const newTask = new Task(data);
            this.tasks.push(newTask);
            const listContainer = e.target.closest(".list");
            const tasksContainer = listContainer.querySelector('.list__tasks');
            newTask.render(tasksContainer);
            this.titleInput.value = '';
        });
    }
}

const newListForm = document.querySelector('.newList-form')
const addListBtn = document.querySelector('#newListAdd');
const closeFromBtn = document.querySelector('#newListCancel');
const initFormBtn = document.querySelector('#newListOpenForm')

initFormBtn.addEventListener('click', () => {
    newListForm.style.display = 'flex';
    initFormBtn.style.display = 'none';
});

closeFromBtn.addEventListener('click', () => {
    newListForm.style.display = 'none';
    initFormBtn.style.display = 'block';
});

addListBtn.addEventListener('click', () => {
    const user_id = newListForm.querySelector('input[name="user_id"]').value;
    const title = newListForm.querySelector('input[name="title"]').value;

    fetch(`/list`, {
        method: 'POST',
        body: JSON.stringify({ user_id, title })
    }).then(response => response.json())
      .then((data) => {
        const list = new TaskList(data);
        lists.push(list);
        newListForm.querySelector('input[name="title"]').value = '';
        newListForm.style.display = 'none';
        initFormBtn.style.display = 'block';
    });
});

window.onload = () => {
    const body = document.querySelector('body');
    lists = JSON.parse(body.getAttribute('data-lists'));
    showAll();
}