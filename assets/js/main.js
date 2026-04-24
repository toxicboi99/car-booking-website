const navToggle = document.querySelector("[data-nav-toggle]");
const nav = document.querySelector("[data-nav]");

if (navToggle && nav) {
    navToggle.addEventListener("click", () => {
        nav.classList.toggle("is-open");
    });
}

document.querySelectorAll("[data-tab-button]").forEach((button) => {
    button.addEventListener("click", () => {
        const group = button.getAttribute("data-tab-group-name");
        const target = button.getAttribute("data-tab-button");

        document.querySelectorAll(`[data-tab-group-name="${group}"][data-tab-button]`).forEach((item) => {
            item.classList.remove("is-active");
        });

        document.querySelectorAll(`[data-tab-group-name="${group}"][data-tab-panel]`).forEach((panel) => {
            panel.classList.remove("is-active");
        });

        button.classList.add("is-active");
        const panel = document.querySelector(`[data-tab-panel="${target}"][data-tab-group-name="${group}"]`);
        if (panel) {
            panel.classList.add("is-active");
        }
    });
});

document.querySelectorAll("[data-scroll-target]").forEach((button) => {
    button.addEventListener("click", () => {
        const track = document.getElementById(button.getAttribute("data-scroll-target"));
        if (!track) {
            return;
        }

        const direction = button.getAttribute("data-scroll-direction") === "prev" ? -1 : 1;
        const amount = Math.min(track.clientWidth * 0.85, 360) * direction;

        track.scrollBy({
            left: amount,
            behavior: "smooth",
        });
    });
});

const floatingActions = document.querySelector("[data-floating-actions]");
const floatingToggle = document.querySelector("[data-floating-toggle]");
const floatingPanel = document.querySelector("[data-floating-panel]");
const floatingToggleIcon = document.querySelector("[data-floating-toggle-icon]");
const floatingToggleLabel = document.querySelector("[data-floating-toggle-label]");

if (floatingActions && floatingToggle && floatingPanel && floatingToggleIcon && floatingToggleLabel) {
    const syncFloatingActions = () => {
        const isCollapsed = floatingActions.classList.contains("is-collapsed");

        floatingPanel.hidden = isCollapsed;
        floatingToggle.setAttribute("aria-expanded", String(!isCollapsed));
        floatingToggleIcon.textContent = isCollapsed ? "+" : "X";
        floatingToggleLabel.textContent = isCollapsed ? "Open" : "Hide";
    };

    floatingToggle.addEventListener("click", () => {
        floatingActions.classList.toggle("is-collapsed");
        syncFloatingActions();
    });

    syncFloatingActions();
}
