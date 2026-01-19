"use strict";

const table = document.querySelector(".users");
const delete_container = document.querySelector(".delete-container");

table.addEventListener("click", (e) => {
  if (e.target.dataset.action === "delete") {
    const target = e.target.parentElement;
    const name = target.dataset.name;
    const id = target.dataset.id;
    delete_container.innerHTML = confirm_delete(id, name);

    const remove = document.querySelector("button[type='submit']");
    const close = document.querySelector("button[type='button']");

    close.addEventListener("click", () => {
      delete_container.innerHTML = "";
    });

    remove.addEventListener("click", () => {
      window.location.href = `/admin/user/${id}/delete`;
      delete_container.innerHTML = "";
    });
  }
});

const confirm_delete = function (id, name) {
  return `
    <div class="confirm-delete">
      <form action="#" method="POST">
        <h1>Удаление пользователя</h1>
        <h3>Уверен, что хочешь удалить пользователя ${name}?</h3>
        <p>Пользователь будет удалён из базы данных и его восстановление будет не возможно</p>
        <button type="submit">Удалить</button><button type="button">Упс, предумал</button>
      </div>
  `;
};
