// Contact form: sends the message to our own API (POST /api/contact) and shows the result.
export function initContactForm() {
    const form = document.getElementById("contact-form");
    if (!form) return;

    const submit = document.getElementById("contact-submit");
    const status = document.getElementById("contact-status");
    const submitLabel = submit.textContent.trim();

    const clearFeedback = () => {
        form.querySelectorAll("[data-error-for]").forEach((node) => {
            node.hidden = true;
            node.textContent = "";
        });

        form.querySelectorAll(".form-field").forEach((field) =>
            field.removeAttribute("aria-invalid"),
        );
        status.hidden = true;
    };

    const showStatus = (type, text) => {
        status.dataset.type = type;
        status.textContent = text;
        status.hidden = false;
    };

    // Laravel returns { errors: { field: ['message', ...] } } with status 422.
    const showFieldErrors = (errors) => {
        let firstInvalid = null;

        Object.entries(errors).forEach(([field, messages]) => {
            const node = form.querySelector('[data-error-for="' + field + '"]');
            const input = form.elements[field];

            if (node) {
                node.textContent = messages[0];
                node.hidden = false;
            }

            if (input) {
                input.setAttribute("aria-invalid", "true");
                firstInvalid = firstInvalid ?? input;
            }
        });

        firstInvalid?.focus();
    };

    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        clearFeedback();

        submit.disabled = true;
        submit.textContent = "Sending...";

        try {
            const response = await fetch("/api/contact", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(Object.fromEntries(new FormData(form))),
            });

            const data = await response.json().catch(() => ({}));

            if (response.status === 201) {
                form.reset();
                showStatus(
                    "success",
                    data.message ??
                        "Thanks for reaching out! Your message has been sent.",
                );
            } else if (response.status === 422) {
                showFieldErrors(data.errors ?? {});
            } else if (response.status === 429) {
                showStatus(
                    "warning",
                    "Too many messages. Please wait a minute and try again.",
                );
            } else {
                showStatus(
                    "error",
                    "Something went wrong. Please try again later.",
                );
            }
        } catch (error) {
            showStatus(
                "error",
                "Couldn't send your message. Please check your connection and try again.",
            );
        } finally {
            submit.disabled = false;
            submit.textContent = submitLabel;
        }
    });
}
