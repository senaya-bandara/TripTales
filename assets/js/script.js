document.addEventListener("DOMContentLoaded", () => {
    const deleteForms = document.querySelectorAll(".delete-form");

    deleteForms.forEach(form => {
        form.addEventListener("submit", (event) => {
            if (!confirm("Are you sure you want to delete this blog post?")) {
                event.preventDefault();
            }
        });
    });
});
