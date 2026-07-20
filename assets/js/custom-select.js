function closeAllDropdowns() {
  document.querySelectorAll(".select-dropdown.is-open").forEach((dropdown) => {
    dropdown.classList.remove("is-open");
    const trigger = dropdown.previousElementSibling;
    if (trigger && trigger.classList.contains("select-trigger")) {
      trigger.setAttribute("aria-expanded", "false");
    }
  });
}

function enhanceSelect(select) {
  const wrapper = select.closest(".select");
  if (!wrapper || wrapper.classList.contains("enhanced")) return;

  const trigger = document.createElement("button");
  trigger.type = "button";
  trigger.className = "select-trigger";
  trigger.setAttribute("aria-haspopup", "listbox");
  trigger.setAttribute("aria-expanded", "false");

  const label = document.createElement("span");
  label.className = "select-trigger-label";

  const chevron = document.createElement("i");
  chevron.className = "select-trigger-chevron";
  chevron.setAttribute("aria-hidden", "true");
  chevron.textContent = "▾";

  trigger.appendChild(label);
  trigger.appendChild(chevron);

  const dropdown = document.createElement("ul");
  dropdown.className = "select-dropdown";
  dropdown.setAttribute("role", "listbox");
  if (select.hasAttribute("aria-label")) {
    dropdown.setAttribute("aria-label", select.getAttribute("aria-label"));
  }

  const options = Array.from(select.options);
  const optionEls = options.map((option) => {
    const li = document.createElement("li");
    li.className = "select-option";
    li.setAttribute("role", "option");
    li.tabIndex = -1;
    li.dataset.value = option.value;
    li.setAttribute("aria-selected", option.selected ? "true" : "false");

    const text = document.createElement("span");
    text.textContent = option.textContent.trim();

    const check = document.createElement("span");
    check.className = "select-option-check";
    check.setAttribute("aria-hidden", "true");
    check.textContent = "✓";

    li.appendChild(text);
    li.appendChild(check);
    dropdown.appendChild(li);
    return li;
  });

  let focusedIndex = -1;

  function syncLabel() {
    const selected = select.options[select.selectedIndex];
    label.textContent = selected ? selected.textContent.trim() : "";
  }

  function setSelected(value) {
    optionEls.forEach((el) => {
      el.setAttribute("aria-selected", el.dataset.value === value ? "true" : "false");
    });
  }

  function setFocusedOption(index) {
    optionEls.forEach((el) => el.classList.remove("is-focused"));
    if (index >= 0 && index < optionEls.length) {
      optionEls[index].classList.add("is-focused");
      optionEls[index].focus();
    }
    focusedIndex = index;
  }

  function isOpen() {
    return dropdown.classList.contains("is-open");
  }

  function openDropdown() {
    closeAllDropdowns();
    dropdown.classList.add("is-open");
    trigger.setAttribute("aria-expanded", "true");
    const currentIndex = options.findIndex((o) => o.value === select.value);
    setFocusedOption(currentIndex >= 0 ? currentIndex : 0);
  }

  function closeDropdown(focusTrigger) {
    dropdown.classList.remove("is-open");
    trigger.setAttribute("aria-expanded", "false");
    optionEls.forEach((el) => el.classList.remove("is-focused"));
    focusedIndex = -1;
    if (focusTrigger) trigger.focus();
  }

  function selectValue(value) {
    if (select.value !== value) {
      select.value = value;
      select.dispatchEvent(new Event("change", { bubbles: true }));
    }
    syncLabel();
    setSelected(value);
  }

  trigger.addEventListener("click", () => {
    if (isOpen()) {
      closeDropdown(false);
    } else {
      openDropdown();
    }
  });

  trigger.addEventListener("keydown", (event) => {
    if (event.key === "ArrowDown" || event.key === "Enter" || event.key === " ") {
      event.preventDefault();
      openDropdown();
    } else if (event.key === "Escape" && isOpen()) {
      closeDropdown(false);
    }
  });

  optionEls.forEach((li) => {
    li.addEventListener("click", () => {
      selectValue(li.dataset.value);
      closeDropdown(true);
    });
  });

  dropdown.addEventListener("keydown", (event) => {
    if (event.key === "ArrowDown") {
      event.preventDefault();
      setFocusedOption(Math.min(focusedIndex + 1, optionEls.length - 1));
    } else if (event.key === "ArrowUp") {
      event.preventDefault();
      setFocusedOption(Math.max(focusedIndex - 1, 0));
    } else if (event.key === "Enter" || event.key === " ") {
      event.preventDefault();
      if (focusedIndex >= 0) {
        selectValue(optionEls[focusedIndex].dataset.value);
        closeDropdown(true);
      }
    } else if (event.key === "Escape") {
      event.preventDefault();
      closeDropdown(true);
    } else if (event.key === "Tab") {
      closeDropdown(false);
    }
  });

  document.addEventListener("click", (event) => {
    if (isOpen() && !wrapper.contains(event.target)) {
      closeDropdown(false);
    }
  });

  // Le <select> natif peut encore être modifié par un autre script
  // (ex: theme.js à l'initialisation) : on garde le trigger synchronisé.
  select.addEventListener("change", () => {
    syncLabel();
    setSelected(select.value);
  });

  wrapper.appendChild(trigger);
  wrapper.appendChild(dropdown);
  wrapper.classList.add("enhanced");
  syncLabel();
}

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") closeAllDropdowns();
});

document.querySelectorAll(".select select").forEach(enhanceSelect);
