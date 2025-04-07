// Array untuk menyimpan semua todo
const todos = [];

// Event-event yang akan digunakan
const RENDER_EVENT = "render-todo";
const STORAGE_KEY = "TODO_APPS";
const SAVED_EVENT = "saved-todo";
const STORAGE_EVENT = "storage";
const COMPLETE_EVENT = "complete-todo";
const UNDO_EVENT = "undo-todo";
const REMOVE_EVENT = "remove-todo";

// Key tombol
const COMPLETE_BUTTON = "check-button";
const UNDO_BUTTON = "undo-button";
const TRASH_BUTTON = "trash-button";

// Item ID
const TODO_ITEM_ID = "todoItemId";

// Saat DOM sudah dimuat
document.addEventListener("DOMContentLoaded", function () {
  const submitForm = document.getElementById("form");
  submitForm.addEventListener("submit", function (event) {
    event.preventDefault();
    addTodo();
  });
});

// Fungsi untuk menambahkan todo
function addTodo() {
  const textTodo = document.getElementById("title").value;
  const timestamp = document.getElementById("date").value;

  const generatedID = generateId();
  const todoObject = generateTodoObject(
    generatedID,
    textTodo,
    timestamp,
    false
  );
  todos.push(todoObject);

  document.dispatchEvent(new Event(RENDER_EVENT));
}

// Fungsi untuk generate ID unik
function generateId() {
  return +new Date();
}

// Fungsi untuk membuat object todo
function generateTodoObject(id, task, timestamp, isCompleted) {
  return {
    id,
    task,
    timestamp,
    isCompleted,
  };
}

// Render todo ke halaman
document.addEventListener(RENDER_EVENT, function () {
  const uncompletedTODOList = document.getElementById("todos");
  const completedTODOList = document.getElementById("completed-todos");

  uncompletedTODOList.innerHTML = "";
  completedTODOList.innerHTML = "";

  for (const todoItem of todos) {
    const todoElement = makeTodo(todoItem);

    if (!todoItem.isCompleted) {
      uncompletedTODOList.append(todoElement);
    } else {
      completedTODOList.append(todoElement);
    }
  }
});

// Fungsi membuat elemen todo
function makeTodo(todoObject) {
  const textTitle = document.createElement("h2");
  textTitle.innerText = todoObject.task;

  const textTimestamp = document.createElement("p");
  textTimestamp.innerText = todoObject.timestamp;

  const textContainer = document.createElement("div");
  textContainer.classList.add("inner");
  textContainer.append(textTitle, textTimestamp);

  const container = document.createElement("div");
  container.classList.add("item", "shadow");
  container.append(textContainer);
  container.setAttribute("id", `todo-${todoObject.id}`);

  if (todoObject.isCompleted) {
    const undoButton = document.createElement("button");
    undoButton.classList.add(UNDO_BUTTON);

    undoButton.addEventListener("click", function () {
      undoTaskFromCompleted(todoObject.id);
    });

    const trashButton = document.createElement("button");
    trashButton.classList.add(TRASH_BUTTON);

    trashButton.addEventListener("click", function () {
      removeTaskFromCompleted(todoObject.id);
    });

    container.append(undoButton, trashButton);
  } else {
    const checkButton = document.createElement("button");
    checkButton.classList.add(COMPLETE_BUTTON);

    checkButton.addEventListener("click", function () {
      addTaskToCompleted(todoObject.id);
    });

    container.append(checkButton);
  }

  return container;
}

// Fungsi untuk menyelesaikan todo
function addTaskToCompleted(todoId) {
  const todoTarget = findTodo(todoId);

  if (todoTarget == null) return;

  todoTarget.isCompleted = true;
  document.dispatchEvent(new Event(RENDER_EVENT));
}

// Fungsi untuk mengembalikan todo yang sudah selesai
function undoTaskFromCompleted(todoId) {
  const todoTarget = findTodo(todoId);

  if (todoTarget == null) return;

  todoTarget.isCompleted = false;
  document.dispatchEvent(new Event(RENDER_EVENT));
}

// Fungsi untuk menghapus todo
function removeTaskFromCompleted(todoId) {
  const todoTargetIndex = findTodoIndex(todoId);

  if (todoTargetIndex === -1) return;

  todos.splice(todoTargetIndex, 1);
  document.dispatchEvent(new Event(RENDER_EVENT));
}

// Fungsi untuk mencari todo berdasarkan ID
function findTodo(todoId) {
  return todos.find((todo) => todo.id === todoId);
}

// Fungsi untuk mencari index todo berdasarkan ID
function findTodoIndex(todoId) {
  return todos.findIndex((todo) => todo.id === todoId);
}