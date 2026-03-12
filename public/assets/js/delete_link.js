"use strict";

const table = document.querySelector(".admin-section-table");
const delete_container = document.querySelector(".delete-container");

const confirm_delete = function (name) {
  return `
    <div class="confirm-delete">
      <form action="#" method="POST">
        <h1>Удаление ссылки</h1>
        <h3>Уверен, что хочешь удалить ссылку ${name}?</h3>
        <p>Она будет удалёна из базы данных и её восстановление будет не возможно</p>
        <button type="submit">Удалить</button><button type="button">Упс, предумал</button>
      </div>
  `;
};

table.addEventListener("click", (e) => {
  if (e.target.dataset.action === "delete") {
    const name = e.target.dataset.name;
    const id = e.target.dataset.id;

    delete_container.innerHTML = confirm_delete(name);

    const remove = document.querySelector("button[type='submit']");
    const close = document.querySelector("button[type='button']");

    close.addEventListener("click", () => {
      delete_container.innerHTML = "";
    });

    remove.addEventListener("click", () => {
      window.location.href = `/admin/links/${id}/delete`;
      delete_container.innerHTML = "";
    });
  }
});
